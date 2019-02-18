# Sitegeist Neos Base Distribution

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

## Versioning

<!-- @TODO: Versioning -->

## Deployment

<!-- @TODO: Deployment -->
