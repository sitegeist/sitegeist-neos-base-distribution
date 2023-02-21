# Sitegeist Neos Base Distribution

## Installation

Create a project based on the sitegeist base distribution

```sh
composer create-project sitegeist/neos-base-distribution customer-folder
```

Migrate database and add Admin user
```sh
ddev flow doctrine:migrate
ddev flow user:create --roles Administrator admin admin Admin User
```

## Create custom site package (optional)

Usually you will create a new site-package for your project. Thios repository contains two example packages that sitegeist uses 
as starting point. The `Vendor.Site` package uses a build stack with css-modules and css and typescript colocation with fusion while 
the `Vendor.WheelInventor` package is built using TailwindCss.

You can choose to either copy the included `Vendor.Site` package or the `Vendor.WheelInventor` package into the project namespace:

```sh
ddev flow package:adopt Vendor.Site Customer.Site
```

or:

```sh
ddev flow package:adopt Vendor.WheelInventor Customer.Site
```

**Background:** `Vendor.Site` is a blank site package with no defined frontend components, no content node types and a CSS Modules setup. `Vendor.WheelInventor` uses [Tailwind CSS](https://tailwindcss.com/) and defines a lot of default frontend components and content node types. Use the latter to quickstart projects of medium size.

After cloning the site package you have to require the new package via composer.
```sh
ddev composer require customer/site
```
If you plan no further new sites you may decide to remove the packahges `Vendor.Site`, `Vendor.WheelInventor` and `Sitegeist.Chantalle` now:

```sh
ddev composer remove vendor/site
ddev composer remove vendor/wheelinventor
ddev composer remove sitegeist/chantalle
```

### Altenatively you may want to require an existing external site-package like Neos.Demo

```sh
composer-require neos/demo
```

## Initialize the project git repository

The following commands will initialize the git repository, setup git-hooks and perdorm composer and yarn install.

```sh
git init
make install
```

## Impport site-content or create a new site

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
