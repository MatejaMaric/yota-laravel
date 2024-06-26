{
    description = "Nix Flake package for deploying Serbian YOTA Reservation Laravel web application";
    inputs.nixpkgs.url = "nixpkgs/nixos-23.11";
    outputs = { self, nixpkgs }:
    let
        pkgName = "yota-laravel";
        supportedSystems = [ "x86_64-linux" "x86_64-darwin" "aarch64-linux" "aarch64-darwin" ];
        forAllSystems = nixpkgs.lib.genAttrs supportedSystems;
        nixpkgsFor = forAllSystems (system: import nixpkgs { inherit system; });
    in {
        overlays.default = (final: prev: {
            ${pkgName} = prev.callPackage ./derivation.nix {};
        });
        packages = forAllSystems (system: {
            ${pkgName} = nixpkgsFor.${system}.callPackage ./derivation.nix {};
            default = nixpkgsFor.${system}.callPackage ./derivation.nix {};
        });
        nixosModules.default = import ./configuration.nix;
        nixosConfigurations.testContainer = nixpkgs.lib.nixosSystem {
            system =  "x86_64-linux";
            pkgs = import nixpkgs {
                system =  "x86_64-linux";
                overlays = [ self.overlays.default ];
            };
            modules = [
                self.nixosModules.default
                ({ pkgs, lib, ... }: {
                    system.stateVersion = "23.11";
                    boot.isContainer = true;

                    networking.hostName = "testcontainer";
                    networking.firewall.allowedTCPPorts = [ 80 ];

                    yotaLaravel.enable = true;
                    yotaLaravel.domain = "localhost";
                    yotaLaravel.debug = true;
                })
            ];
        };
    };
}
