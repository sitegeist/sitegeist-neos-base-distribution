# Sitegeist Neos Base Distribution

## Documentation

**Configuration**

* [Override and extend Makefile commands](docs/configuration/extend-makefile.md)
* [Override or extend docker-compose.yml](docs/configuration/override-docker-compose-yml.md)


## Installation

Create a project based on the sitegeist base distribution

```sh
composer create-project sitegeist/neos-base-distribution customer-folder
```

Copy the included `Vendor.Site` package into the project namespace#

```sh
./flow package:adopt Vendor.Site Customer.Site
```

Require the Project package and remove the dependencies to `Vendor.Site` and `Sitegeist.Chantalle`

```sh
composer require customer/site
composer remove vendor/site
composer remove sitegeist/chantalle
```

Initialize the project git repository
```sh
git init
```

Install dependencies via:

```sh
make install
```

Now, get into the container:

```sh
make ssh
```

Finally, perform a site import:

```sh
./flow site:import --package-key Customer.Site
```

## Running the site locally

You can start a development server via:

```sh
make up
```

## Clone project data

You can clone your projectdata directly with make. This command shows up the list and ask for the preset.

```
make clone
```

or type the preset directly:

```sh
make clone preset=dev
```

## Versioning

<!-- @TODO: Versioning -->

## Deployment

<!-- @TODO: Deployment -->
