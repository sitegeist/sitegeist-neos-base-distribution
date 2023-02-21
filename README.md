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

Usually you will create a new site-package for your project. This repository contains two example packages that sitegeist uses 
as starting point for new projects. The `Vendor.Site` package uses a build stack with css-modules and css + typescript colocation, while 
the `Vendor.WheelInventor` package is built using TailwindCss.

A site package has a package key that consists of a vendor Namespace and Package name that are seperated by a dot. You should always
choose a unique package key in the customer namespace to implement custom designs. A good example wozld be `Acme.Marketing`. 
In the following examples `__your_site_package_key__` refers to the the package key you choose here.

You can choose to copy the included `Vendor.Site` package or the `Vendor.WheelInventor` package into the project namespace:

```sh
ddev flow package:adopt Vendor.Site __your_site_package_key__
```

or:

```sh
ddev flow package:adopt Vendor.WheelInventor __your_site_package_key__
```

If you are improving the sitegeis/neos-base-distribution you likely want to skip this and adjust the example packahes as they are.

**Background:** `Vendor.Site` is a blank site package with no defined frontend components, no content node types and a CSS Modules setup. `Vendor.WheelInventor` uses [Tailwind CSS](https://tailwindcss.com/) and defines a lot of default frontend components and content node types. Use the latter to quickstart projects of medium size.

After cloning the site package you have to require the newly created package via composer.

```sh
ddev composer require customer/site
```

After which you may decide to remove the packages `Vendor.Site`, `Vendor.WheelInventor` and `Sitegeist.Chantalle` as they are only needed to kickstart
further site-packages from now on. The package `Sitegeist.Chantalle` is included here as it implements the adopt command for the previous task:

```sh
ddev composer remove vendor/site
ddev composer remove vendor/wheelinventor
ddev composer remove sitegeist/chantalle
```

### Altenatively you may require an existing site-package like Neos.Demo via composer:

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
ddev flow site:import --package-key __your_site_package_key__
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
