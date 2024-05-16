{ lib, pkgs, config, ... }:
let
    cfg = config.yotaLaravel;
    phpPackage = pkgs.php83.buildEnv {
        extensions = { enabled, all }: enabled;
    };
    user = "yota";
    group = "yota";
    dataDir = "/var/lib/yota-laravel";
    runtimeDir = "/run/yota-laravel";
    yotaPkg = pkgs.yota-laravel.override { inherit dataDir runtimeDir; };
    configFile = pkgs.writeText "yota-laravel-env" (lib.generators.toKeyValue { } {
        APP_KEY = ""; # Initialised by yota-data-setup.service
        APP_ENV = if cfg.debug then "local" else "production";
        APP_DEBUG = cfg.debug;
        APP_URL = "https://${cfg.domain}";
        APP_DOMAIN = cfg.domain;
        LOG_CHANNEL = "stderr";
        DB_CONNECTION = "mysql";
        DB_SOCKET = "/run/mysqld/mysqld.sock";
        DB_DATABASE = "yotadb";
        DB_USERNAME = user;
        DB_PORT = 0; # No TCP/IP connection.
    });
in {
    options.yotaLaravel = {
        enable = lib.mkEnableOption "YOTA Laravel";
        domain = lib.mkOption {
            type = lib.types.str;
            default = "yota.yu1srs.org.rs";
            example = "localhost";
            description = "Domain to host YOTA Laravel site";
        };
        debug = lib.mkEnableOption "debug mode";
    };

    config = lib.mkIf cfg.enable {
        users.users = {
            ${user} = {
                isSystemUser = true;
                inherit group;
            };
            # Needed for Nginx to access phpfpm socket
            ${config.services.nginx.user} = {
                extraGroups = [ group ];
            };
        };
        users.groups = {
            ${group} = {};
        };

        environment.systemPackages = [
            phpPackage
            yotaPkg
        ];

        # Cache must live across multiple systemd units runtimes.
        systemd.tmpfiles.rules = [
            "d ${runtimeDir}/        0700 ${user} ${group} - -"
            "d ${runtimeDir}/cache   0700 ${user} ${group} - -"
        ];

        systemd.services.yota-data-setup = {
            description = "YOTA Laravel setup: migrations, environment file update, cache reload, data changes";
            wantedBy = [ "multi-user.target" ];
            after = [ "mysql.service" ];
            requires = [ "mysql.service" ];
            path = [ phpPackage pkgs.rsync ];

            serviceConfig = {
                Type = "oneshot";
                User = user;
                Group = group;
                StateDirectory = lib.mkIf (runtimeDir == "/run/yota-laravel") "yota-laravel";
                UMask = "077";
            };

            script = ''
                # Before running any PHP program, cleanup the code cache.
                # It's necessary if you upgrade the application otherwise you might try to import non-existent modules.
                rm -f ${runtimeDir}/app.php
                rm -rf ${runtimeDir}/cache/*

                rm -f ${dataDir}/.env
                cp --no-preserve=all ${configFile} ${dataDir}/.env

                # Copy the static storage (package provided) to the runtime storage
                mkdir -p ${dataDir}/storage
                rsync -av --no-perms ${yotaPkg}/storage-static/ ${dataDir}/storage
                chmod -R +w ${dataDir}/storage

                chmod g+x ${dataDir}/storage ${dataDir}/storage/app
                chmod -R g+rX ${dataDir}/storage/app/public

                # Link the app.php in the runtime folder.
                # We cannot link the cache folder only because bootstrap folder needs to be writeable.
                ln -sf ${yotaPkg}/bootstrap-static/app.php ${runtimeDir}/app.php

                cd ${yotaPkg}
                php artisan key:generate
                php artisan config:cache
                php artisan route:cache
                php artisan view:cache
            '';
        };

        services.nginx = {
            enable = true;
            virtualHosts."${cfg.domain}" = {
                root = "${yotaPkg}/public";
                locations."/".tryFiles = "$uri $uri/ /index.php?$query_string";
                locations."~ \\.php$".extraConfig = ''
                    fastcgi_split_path_info ^(.+\.php)(/.+)$;
                    fastcgi_pass  unix:${config.services.phpfpm.pools.yota.socket};
                    fastcgi_index index.php;

                    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
                    include ${pkgs.nginx}/conf/fastcgi_params;
                    include ${pkgs.nginx}/conf/fastcgi.conf;
                '';
                extraConfig = ''
                    add_header X-Frame-Options "SAMEORIGIN";
                    add_header X-XSS-Protection "1; mode=block";
                    add_header X-Content-Type-Options "nosniff";
                    index index.html index.htm index.php;
                    error_page 404 /index.php;
                '';
            };
        };

        services.phpfpm.pools.yota = {
            inherit user group phpPackage;

            settings = {
                "listen.owner" = user;
                "listen.group" = group;
                "listen.mode" = "0660";

                # https://www.php.net/manual/en/install.fpm.configuration.php
                "pm" = "dynamic";
                "pm.max_children" = 5;
                "pm.start_servers" = 2;
                "pm.min_spare_servers" = 1;
                "pm.max_spare_servers" = 3;
                "pm.max_requests" = 500;
                "request_terminate_timeout" = 300;
            };
        };

        # This service is actually generated by `services.phpfpm.pools.yota`, here we are overriding values we are interested in
        systemd.services.phpfpm-yota.after = [ "yota-data-setup.service" ];
        systemd.services.phpfpm-yota.requires = [ "mysql.service" "yota-data-setup.service" ];

        services.mysql = {
            enable = true;
            package = pkgs.mariadb;
            initialDatabases = [{
                name = "yotadb";
            }];
            ensureUsers = [{
                name = user;
                ensurePermissions = {
                    "yotadb.*" = "ALL PRIVILEGES";
                };
            }];
        };
    };
}
