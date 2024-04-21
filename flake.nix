{

  inputs = {
    nixpkgs.url = github:NixOS/nixpkgs;
    flake-utils.url = github:numtide/flake-utils;
  };

  description = "ldap-user-manager";

  outputs = { self, nixpkgs, flake-utils }: flake-utils.lib.eachDefaultSystem (system:
  let
    pkgs = nixpkgs.legacyPackages.${system};
    lum = pkgs.stdenvNoCC.mkDerivation {
      pname = "ldap-user-manager";
      version = "v1.102";
      src = self;
      installPhase = ''
        mkdir $out
        cp -r www/* $out/
      '';
    };
  in {
    packages = {
      ldap-user-manager = lum;
      default = lum;
    };
    devShells.php = pkgs.mkShell {
      packages = with pkgs; [
        php
      ];
    };
  });
}