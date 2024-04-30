{
  php83
, fetchNpmDeps
, npmHooks
}:
php83.buildComposerProject (finalAttrs: {
    pname =  "yota-laravel";
    version = "2.0.0";

    src = ./.;

    php = php83.buildEnv {
        extensions = ( { enabled, all }: enabled );
    };
    composerLock = ./composer.lock;
    vendorHash = "sha256-vYuWiX3YxS6ZZ3ngsYDuR6ydggBBwBG8K+KRBP8UqrA=";

    npmDeps = fetchNpmDeps {
        inherit (finalAttrs) src;
        hash = "sha256-clu0a/6HjPXwNAw1BqVYeALvtinLda8z6/HT31Ucphw=";
    };

    nativeBuildInputs = [ npmHooks.npmInstallHook npmHooks.npmConfigHook ];

    postBuild = ''
        npm run prod
    '';

    postInstall = ''
        php artisan config:cache
        php artisan route:cache
        php artisan view:cache
    '';
})
