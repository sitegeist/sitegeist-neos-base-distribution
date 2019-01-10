###############################################################################
###############################################################################
##                                                                           ##
##                     Sitegeist Neos Base Distribution                      ##
##                                                                           ##
###############################################################################
###############################################################################

#
# @author Wilhelm Behncke <behncke@sitegeist.de>
#

###############################################################################
#                                VARIABLES                                    #
###############################################################################
SHELL=/bin/bash
COMPOSE_EXEC=docker-compose exec -T --user www-data php-fpm ssh-agent
COMPOSE_EXEC_ROOT=docker-compose exec -T php-fpm
export PATH := ./node_modules/.bin:./bin:$(PATH)

-include ./Build/config.makefile
-include ./Custom/before.makefile

###############################################################################
#                                  README                                     #
###############################################################################

.DEFAULT:
readme::
	@printf "\n"
	@printf "\t\t\t\033[0;1mSitegeist Neos Base Distribution\033[0m\n"
	@printf "\n"
	@printf " Available Targets\n"
	@printf " --------------------------------------------------------------------\n"
	@printf "\033[0;1m install \033[0m \t Install the project\n"
	@printf "\033[0;1m cleanup \033[0m \t Cleanup all files and make a fresh install\n"
	@printf "\033[0;1m lint \033[0m \t\t Lint all sources\n"
	@printf "\033[0;1m build \033[0m \t Build Frontend\n"
	@printf "\033[0;1m watch \033[0m \t Build Frontend (Watch Mode)\n"
	@printf "\n"

###############################################################################
#                             INSTALL & CLEANUP                               #
###############################################################################
environment::
	@docker --version
	@docker-compose --version
	@echo Node $$(node --version)
	@echo Yarn $$(yarn --version)

install::
	@if [ -z $${CI+x} ]; then $(MAKE) environment; fi
	@if [ -z $${CI+x} ]; then cp ./.git/hooks/pre-commit.sample ./.git/hooks/pre-commit && echo "make lint" >> ./.git/hooks/pre-commit; fi
	time $(SHELL) -c "$(COMPOSE_EXEC) composer install & yarn install & wait"

cleanup::
	@rm -rf Data/Temporary/
	@rm -rf Packages/
	@rm -rf bin/
	@rm -rf node_modules/
	$(MAKE) install
	$(MAKE) build

###############################################################################
#                                LINTING & QA                                 #
###############################################################################
lint-distribution::
	@echo "Lint Distribution"
	@./flow guidelines:validateDistribution && ./flow guidelines:validatePackages

lint-editorconfig::
	@echo "Lint .editorconfig"
	@editorconfig-checker -d -e 'Public|Sites.xml|.*.css.fusion|.*.css.json|.*.js.fusion' ./DistributionPackages/*

lint-php::
	@echo "Lint PHP Sources"
	@for package in DistributionPackages/*; do \
		if [ -d "$$package/Classes" ]; \
		then phpcs --standard=PSR2 $$package/Classes || exit 1; fi \
	done

lint-css::
	@echo "Lint CSS Sources"
	@stylelint DistributionPackages/*/Resources/Private/**/*.css

lint-js::
	@echo "Lint JavaScript Sources"
	@eslint DistributionPackages/*/Resources/Private/**/*.js

lint::
	@$(MAKE) -s lint-distribution
	@$(MAKE) -s lint-editorconfig
	@$(MAKE) -s lint-php
	@$(MAKE) -s lint-css
	@$(MAKE) -s lint-js

###############################################################################
#                               FRONTEND BUILD                                #
###############################################################################
.PHONY: build
build::
	@time webpack -p --hide-modules --mode production --optimize-dedupe --progress

watch::
	@webpack --mode development -w

###############################################################################
#                                  Docker                                     #
###############################################################################
up::
	@docker-compose up -d
	@$(COMPOSE_EXEC_ROOT) usermod --uid $$UID www-data
	@$(COMPOSE_EXEC_ROOT) chown www-data:www-data \
		/project /project/bin /project/Data /project/Packages /project/Web
	@$(COMPOSE_EXEC_ROOT) chown -R www-data:www-data \
		/project/Build
	$(MAKE) install

down::
	@docker-compose down --remove-orphans

prune::
	@docker-compose down --remove-orphans --volumes

restart::
	$(MAKE) down
	$(MAKE) up

logs::
	@docker-compose logs -f

flow::
	@docker-compose exec --user $$UID php-fpm ssh-agent /project/flow $(FLOW_ARGS)

###############################################################################
#                                  SSH                                        #
###############################################################################
ssh::
	docker-compose exec --user $$UID php-fpm ssh-agent $(SHELL)

ssh-root::
	docker-compose exec --user root php-fpm ssh-agent $(SHELL)

ssh-mariadb::
	docker-compose exec mariadb $(SHELL) -c "mysql -uroot -p$(CRED_MYSQL_ROOT_PASSWORD) $(CRED_MYSQL_DATABASE)"

ssh-webserver::
	docker-compose exec webserver sh

###############################################################################
#                                DEPLOYMENT                                   #
###############################################################################
deploy-develop::
	@bin/dep deploy develop -vv --revision="develop"

deploy-staging::
	@echo "ERROR: There's no stage deployment configured yet"
	@exit 1

deploy-live::
	@echo "ERROR: There's no live deployment configured yet"
	@exit 1

-include ./Custom/after.makefile
