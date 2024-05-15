### About:

Website made for [Serbian YOTA section](https://yota.yu1srs.org.rs).
Primarily used for special callsign and frequency reservation handling, but it also has a gallery and a news system.

### Deployment:

This project is currently in the process of packaging using [Nix](https://nixos.org/).
You can use [NixOS Containers](https://nixos.org/manual/nixos/stable/#ch-containers) to test things out.
For example:

```bash
# Create a container
sudo nixos-container create yotalaravel --flake .#testContainer

# List containers
sudo nixos-container list

# Start a container
sudo nixos-container start yotalaravel

# Check container logs
sudo journalctl -M yotalaravel

# Show container ip address
sudo nixos-container show-ip yotalaravel

# Show the index page served by a container with IP 10.233.1.2
curl http://10.233.1.2

# Login into a container
sudo nixos-container root-login yotalaravel

# Update a container
sudo nixos-container update yotalaravel --flake .#testContainer

# Remove a container
sudo nixos-container destroy yotalaravel
```

### License:

Copyright (C) 2020  Mateja Maric

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
