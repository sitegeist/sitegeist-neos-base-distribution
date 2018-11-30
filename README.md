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

First, instal dependencies via:

```sh
make install
```

Then, create a database:

```sql
create database vendor_site_dev collate utf8_unicode_ci;
```

and configure the connection to it in `Configuration/Development/Settings.yaml` as such:

```yaml
Neos:
  Flow:
    persistence:
      backendOptions:
        dbname: 'vendor_site_dev'
        user: '<your database user>'
        password: '<your database password>'
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