# Sitegeist Neos Base Distribution

## System Requirements

### Linux + Mac

* docker >=17.06.1-ce
* php >= 7.2
* composer >=1.6
* node >= 8.10 (LTS)
* yarn >= 1.7
* MariaDB >= 10.2.2

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
./flow server:run [--port <Optional Port>]
```

## Versioning

<!-- @TODO: Versioning -->

## Deployment

<!-- @TODO: Deployment -->
