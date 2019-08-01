# Sitegeist Neos Base Distribution

## Documentation

**Configuration**

* [Override and extend Makefile commands](docs/configuration/extend-makefile.md)
* [Override or extend docker-compose.yml](docs/configuration/override-docker-compose-yml.md)


## System Requirements

### Linux + Mac

* docker >= 18.09.1
* docker-compose >= 1.23.2
* node >= 10 (LTS)
* yarn >= 1.13

## Installation

Install dependencies via:

```sh
make install
```

Now, run all database migrations:

```sh
./flow doctrine:migrate
```

Finally, perform a site import:

```sh
./flow site:import --package-key Sitegeist.Site.Placeholder
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
