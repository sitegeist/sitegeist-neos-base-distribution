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
COMPOSE_EXEC_ROOT=docker-compose exec -T --user root php-fpm
export TS_NODE_PROJECT=./tsconfig.json
export HOST_USER=$(shell id -u)
export HOST_GROUP=$(shell id -g)
export PATH := ./node_modules/.bin:./bin:$(PATH)
COMPOSE_EXEC=docker-compose exec -T --user $(HOST_USER) php-fpm ssh-agent

-include ./Build/config.makefile
-include $(DIR_CONFIG_GLOBAL)/before.makefile
-include $(DIR_CONFIG_LOCAL)/before.makefile

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

@install-githooks::
	@if [ -z $${CI+x} ]; then $(MAKE) environment; fi
	@if [ -z $${CI+x} ]; then cp ./.git/hooks/pre-commit.sample ./.git/hooks/pre-commit && \
		echo "make lint" >> ./.git/hooks/pre-commit; fi

@install-composer::
	@$(COMPOSE_EXEC) composer install

@install-yarn::
	@yarn install
	@ln -sf ../node/bin/node ./node_modules/.bin/node

@install-create-user::
	@$(COMPOSE_EXEC_ROOT) mkdir -p /home/hostuser
	@$(COMPOSE_EXEC_ROOT) useradd -u $(HOST_USER) hostuser
	@$(COMPOSE_EXEC_ROOT) chown hostuser /home/hostuser

install::
	$(MAKE) -s up
	@time $(MAKE) -s -j 3 @install-githooks @install-composer @install-yarn
	$(MAKE) -s @install-create-user
	@./flow flow:cache:flush
	@./flow flow:cache:warmup
	@./flow flow:package:rescan

cleanup::
	@rm -rf ./Data/Temporary/*
	@rm -rf ./Packages/*
	@rm -rf ./bin/*
	@rm -rf node_modules/
	@$(MAKE) install
	@$(MAKE) build
	@$(COMPOSE_EXEC) ./flow flow:package:rescan

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

test-e2e::
	@docker-compose exec testcafe /opt/testcafe/docker/testcafe-docker.sh 'chromium --no-sandbox' /tests/*.ts

test-component-semantics::
	jest --verbose -t '#semantics'

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
	@docker-compose up --force-recreate -d
	@$(COMPOSE_EXEC_ROOT) chmod -R 0777 /data

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
	@docker-compose exec -T --user $(HOST_USER) php-fpm ssh-agent /project/flow $(FLOW_ARGS)

###############################################################################
#                                  SSH                                        #
###############################################################################
ssh::
	docker-compose exec --user $(HOST_USER) php-fpm ssh-agent $(SHELL)

ssh-root::
	docker-compose exec --user root php-fpm ssh-agent $(SHELL)

ssh-mariadb::
	docker-compose exec mariadb $(SHELL) -c "mysql -uroot -p$(CRED_MYSQL_ROOT_PASSWORD) $(CRED_MYSQL_DATABASE)"

ssh-webserver::
	docker-compose exec -w /etc/nginx webserver sh

###############################################################################
#                                CLONE                                        #
###############################################################################
clone::
	@docker-compose exec --user $(HOST_USER) php-fpm ssh-agent /bin/bash -c "\
		./flow clone:list; \
		./flow clone:preset --yes"

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

-include $(DIR_CONFIG_GLOBAL)/after.makefile
-include $(DIR_CONFIG_LOCAL)/after.makefile
