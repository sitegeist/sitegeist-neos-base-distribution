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
export TS_NODE_PROJECT=./tsconfig.json
export PATH := ./node_modules/.bin:./bin:$(PATH)

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
	@ddev version
	@echo Node $$(node --version)
	@echo Yarn $$(yarn --version)

@install-githooks::
	@if [ -z $${CI+x} ]; then $(MAKE) environment; fi
	@if [ -z $${CI+x} ]; then cp ./.git/hooks/pre-commit.sample ./.git/hooks/pre-commit && \
		echo "make lint" >> ./.git/hooks/pre-commit; fi

@install-composer::
	@ddev composer install

@install-yarn::
	@yarn install
	@ln -sf ../node/bin/node ./node_modules/.bin/node

install::
	@time $(MAKE) -s up
	@time $(MAKE) -s -j 3 @install-githooks @install-composer @install-yarn
	@time $(MAKE) -s -j 2 build flush

flush::
	@ddev flow flow:cache:flush --force
	@ddev flow flow:cache:warmup
	@ddev flow flow:package:rescan
	@ddev flow doctrine:migrate
	@ddev flow resource:publish

cleanup::
	@rm -rf ./Data/Temporary/*
	@rm -rf ./Packages/*
	@rm -rf ./bin/*
	@rm -rf node_modules/
	@$(MAKE) install

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
#                                  DDEV                                     #
###############################################################################
up::
	@ddev start

down::
	@ddev stop

prune::
	@ddev delete --omit-snapshot

restart::
	@ddev restart

logs::
	@ddev logs -f

###############################################################################
#                                  SSH                                        #
###############################################################################
ssh::
	@ddev ssh

ssh-mariadb::
	@ddev mysql

###############################################################################
#                                CLONE                                        #
###############################################################################
clone::
	@$(MAKE) auth
	@ddev flow clone:list && ddev flow clone:preset $(preset) --yes

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
