{ stdenvNoCC, php83, cacert, nodejs_20, lib }: stdenvNoCC.mkDerivation (finalAttrs:
let
    php' = php83.withExtensions ({ enabled, all }: enabled );
in {
    pname =  "yota-laravel";
    version = "2.0.0";

    src = ./.;

    nativeBuildInputs = [
        php'
        php'.packages.composer
        cacert
        nodejs_20
    ];

    COMPOSER_CACHE_DIR = "/dev/null";
    COMPOSER_MIRROR_PATH_REPOS = "1";
    COMPOSER_HTACCESS_PROTECT = "0";
    COMPOSER_DISABLE_NETWORK = "0";
    NODE_OPTIONS="--openssl-legacy-provider";

    buildPhase = ''
        export HOME=$(pwd)
        composer --no-ansi --no-interaction --no-dev --no-plugins --no-scripts install
        npm ci
        npm run production
        php artisan config:cache
        php artisan route:cache
        php artisan view:cache
    '';

    dontStrip = true;
    dontPatchShebangs = true;

    outputHashAlgo = "sha256";
    outputHashMode = "recursive";
    outputHash = lib.fakeSha256;

    installPhase = ''
        mkdir $out
        cp -r . $out
    '';
})
