{ lib, pkgs, config, ... }:
let
    cfg = config.yotaLaravel;
    php' = pkgs.php83.buildEnv {
        extensions = { enabled, all }: enabled;
    };
in {
    options.yotaLaravel = {
        enable = lib.mkEnableOption "YOTA Laravel";
        domain = lib.mkOption {
            type = lib.types.str;
            default = "yota.yu1srs.org.rs";
            example = "localhost";
            description = "Domain to host YOTA Laravel site";
        };
    };

    config = lib.mkIf cfg.enable {
        users.users = {
            yotapool = {
                isSystemUser = true;
                group = "yotapool";
            };
        };
        users.groups = {
            yotapool = {};
        };

        environment.systemPackages = [
            php'
            pkgs.yota-laravel
        ];

        services.nginx.enable = true;
        services.nginx.virtualHosts."${cfg.domain}" = {
            root = "${pkgs.yota-laravel}/share/php/yota-laravel/public";

            locations."/".tryFiles = "$uri $uri/ /index.php?$query_string";

            locations."~ \\.php$".extraConfig = ''
                fastcgi_pass  unix:${config.services.phpfpm.pools.yotapool.socket};
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
                include ${pkgs.nginx}/conf/fastcgi_params;
                include ${pkgs.nginx}/conf/fastcgi.conf;
            '';

            extraConfig = ''
                add_header X-Frame-Options "SAMEORIGIN";
                add_header X-XSS-Protection "1; mode=block";
                add_header X-Content-Type-Options "nosniff";
            '';
        };

        services.phpfpm.pools.yotapool = {
            user = "yotapool";
            group = "yotapool";

            phpPackage = php';

            settings = {
              "listen.owner" = config.services.nginx.user;
              "listen.group" = config.services.nginx.group;

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
