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

## Clone project data

You can clone your projectdata directly with make. This command shows up the list and ask for the preset.

```
make clone
```

or type the preset directly:

```sh
make clone preset=dev
```

## Multi domain

You can add multiple domains to your /etc/hosts file. If you need this feature you have to change the **DomainScripts/project.env.makefile** and add your domains to the variable **PROJECT_MULTIDOMAIN_HOSTNAMES** and change the Makefile up:: part.

```
up::
	@docker-compose up --force-recreate -d
	@$(MAKE) -si @install-create-user & \
	 $(COMPOSE_EXEC_ROOT) chmod -R 0777 /data
	@$(MAKE) host-add
	@$(MAKE) multidomain-add
```

## Versioning

<!-- @TODO: Versioning -->

## Deployment

<!-- @TODO: Deployment -->
