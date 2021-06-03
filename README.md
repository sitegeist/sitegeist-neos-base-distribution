# Sitegeist Neos Base Distribution

## Installation

Create a project based on the sitegeist base distribution

```sh
composer create-project sitegeist/neos-base-distribution customer-folder
```

Migrate database and add Admin user
```sh
ddev flow doctrine:migrate
ddev flow create:user --roles Administrator admin admin Admin User
```

You can choose to either copy the included `Vendor.Site` package or the `Vendor.WheelInventor` package into the project namespace:

```sh
ddev flow package:adopt Vendor.Site Customer.Site
```

or:

```sh
ddev flow package:adopt Vendor.WheelInventor Customer.Site
```

**Background:** `Vendor.Site` is a blank site package with no defined frontend components, no content node types and a CSS Modules setup. `Vendor.WheelInventor` uses [Tailwind CSS](https://tailwindcss.com/) and defines a lot of default frontend components and content node types. Use the latter to quickstart projects of medium size.

Require the Project package and remove the dependencies to `Vendor.Site`, `Vendor.WheelInventor` and `Sitegeist.Chantalle`:

```sh
ddev composer require customer/site
ddev composer remove vendor/site
ddev composer remove vendor/wheelinventor
ddev composer remove sitegeist/chantalle
```

Initialize the project git repository
```sh
git init
```

Install dependencies via:

```sh
make install
```

Finally, perform a site import:

```sh
ddev flow site:import --package-key Customer.Site
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
make clone
```

## Versioning

<!-- @TODO: Versioning -->

## Deployment

<!-- @TODO: Deployment -->
