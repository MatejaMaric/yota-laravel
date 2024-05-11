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
        APP_ENV = "production";
        APP_DEBUG = false;
        APP_URL = "https://${cfg.domain}";
        APP_DOMAIN = cfg.domain;
        LOG_CHANNEL = "stderr";
        DB_CONNECTION = "mysql";
        DB_SOCKET = "/run/mysqld/mysqld.sock";
        DB_DATABASE = "yotadb";
        DB_USERNAME = "yota";
        # No TCP/IP connection.
        DB_PORT = 0;
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
        secretFile = lib.mkOption {
            type = lib.types.path;
            description = ''
                A secret file to be sourced for the .env settings.
                Place `APP_KEY` and other settings that should not end up in the Nix store here.
            '';
        };
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

        systemd.services.yota-data-setup = {
            description = "YOTA Laravel setup: migrations, environment file update, cache reload, data changes";
            wantedBy = [ "multi-user.target" ];
            after = [ "mysql.service" ];
            requires = [ "mysql.service" ];
            path = [ phpPackage ];

            serviceConfig = {
                Type = "oneshot";
                User = user;
                Group = group;
                StateDirectory = dataDir;
                LoadCredential = "env-secrets:${cfg.secretFile}";
                UMask = "077";
            };

            script = ''
            # Before running any PHP program, cleanup the code cache.
            # It's necessary if you upgrade the application otherwise you might
            # try to import non-existent modules.
            rm -f ${runtimeDir}/app.php
            rm -rf ${runtimeDir}/cache/*

            # Concatenate non-secret .env and secret .env
            rm -f ${dataDir}/.env
            cp --no-preserve=all ${configFile} ${dataDir}/.env
            echo -e '\n' >> ${dataDir}/.env
            cat "$CREDENTIALS_DIRECTORY/env-secrets" >> ${dataDir}/.env

            # Link the static storage (package provided) to the runtime storage
            # Necessary for cities.json and static images.
            mkdir -p ${dataDir}/storage
            rsync -av --no-perms ${yotaPkg}/storage-static/ ${dataDir}/storage
            chmod -R +w ${dataDir}/storage

            chmod g+x ${dataDir}/storage ${dataDir}/storage/app
            chmod -R g+rX ${dataDir}/storage/app/public

            # Link the app.php in the runtime folder.
            # We cannot link the cache folder only because bootstrap folder needs to be writeable.
            ln -sf ${yotaPkg}/bootstrap-static/app.php ${runtimeDir}/app.php

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

        services.mysql = {
            enable = true;
            package = pkgs.mariadb;
        };
    };
}
