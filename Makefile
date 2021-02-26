###############################################################################
###############################################################################
##                                                                           ##
##                     Sitegeist Neos Base Distribution                      ##
##                                                                           ##
###############################################################################
###############################################################################

#
# @author Wilhelm Behncke <behncke@sitegeist.de>
# @author Bernhard Schmitt <schmitt@sitegeist.de>
# @author Andreas Freund <freund@sitegeist.de>
# @author Masoud Hedayati <hedayati@sitegeist.de>
# @author Martin Ficzel <ficzel@sitegeist.de>
# @author Dogan Günaydin <guenaydin@sitegeist.de>
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
	@printf "\t\t\033[0;1mSitegeist Neos Base Distribution\033[0m\n"
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
	@ddev exec echo Node $$(node --version)
	@ddev exec echo Yarn $$(yarn --version)

@install-githooks::
	@if [ -z $${CI+x} ]; then $(MAKE) environment; fi
	@if [ -z $${CI+x} ]; then cp ./.git/hooks/pre-commit.sample ./.git/hooks/pre-commit && \
		echo "make lint" >> ./.git/hooks/pre-commit; fi

@install-composer::
	@ddev composer install

@install-yarn::
	@ddev exec yarn

install::
	@mkdir -p Data/Logs
	@$(MAKE) -s flush

flush::
	@ddev composer flush

cleanup::
	@ddev composer cleanup:php

###############################################################################
#                                LINTING & QA                                 #
###############################################################################

lint-editorconfig::
	@echo "Lint .editorconfig"
	@ddev composer lint:editorconfig

lint-php::
	@echo "Lint PHP Sources".
	@ddev composer lint:php

lint-css::
	@echo "Lint CSS Sources"
	ddev exec node_modules/.bin/stylelint DistributionPackages/*/Resources/Private/**/*.css

lint-js::
ifneq (,$(wildcard DistributionPackages/*/Resources/Private/**/*.js))
	@echo "Lint JavaScript Sources"
	@ddev exec node_modules/.bin/eslint DistributionPackages/*/Resources/Private/**/*.js
else
	@echo "No JavaScript Source To Lint"
endif

lint::
	@$(MAKE) -s lint-editorconfig
	@$(MAKE) -s lint-php
	@$(MAKE) -s lint-css
	@$(MAKE) -s lint-js

test-component-semantics::
	ddev exec node_modules/.bin/jest --verbose -t '#semantics'

test::
	@ddev yarn test:component-semantics

analyse::
	@ddev exec bin/phpstan analyse --level 8 DistributionPackages

###############################################################################
#                               FRONTEND BUILD                                #
###############################################################################
.PHONY: build
build:: @install-yarn
	@ddev exec time node_modules/.bin/webpack -p --hide-modules --mode production --optimize-dedupe --progress

watch::
	@ddev exec node_modules/.bin/webpack --mode development -w

###############################################################################
#                                  DDEV                                     #
###############################################################################
up::
	@ddev start

down::
	@ddev stop --unlist

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
	@ddev composer clone

###############################################################################
#                                DEPLOYMENT                                   #
###############################################################################
deploy-develop::
	@ddev composer deploy:develop

deploy-staging::
	@ddev composer deploy:staging

deploy-master::
	@ddev composer deploy:master

-include $(DIR_CONFIG_GLOBAL)/after.makefile
-include $(DIR_CONFIG_LOCAL)/after.makefile
