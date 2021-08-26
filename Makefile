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
	@printf "\033[0;1m up \033[0m \t\t Start a development server\n"
	@printf "\033[0;1m down \033[0m \t\t Stop the development server\n"
	@printf "\033[0;1m prune \033[0m \t Stop the development server and remove all traces of it\n"
	@printf "\033[0;1m restart \033[0m \t Restart the development server\n"
	@printf "\033[0;1m logs \033[0m \t\t Show logs from the development server\n"
	@printf "\033[0;1m ssh \033[0m \t\t Start a shell on the development server\n"
	@printf "\033[0;1m ssh-mariadb \033[0m \t Run the mariadb client on the development server\n"
	@printf "\033[0;1m clone \033[0m \t Clone data from a deployed instance\n"
	@printf "\n"

###############################################################################
#                             INSTALL & CLEANUP                               #
###############################################################################
environment::
	@ddev version
	@echo mkcert $$(mkcert -version)
	@ddev exec composer --version
	@echo Node $$(ddev exec node --version)
	@echo Yarn $$(ddev yarn --version)

install-githooks::
	@if [ -z $${CI+x} ]; then touch ./.git/hooks/pre-commit && \
		echo "#!/bin/sh" > ./.git/hooks/pre-commit && \
		echo "make lint" >> ./.git/hooks/pre-commit && \
		chmod +x ./.git/hooks/pre-commit; fi

install-composer::
	@ddev composer install

install-yarn::
	@ddev yarn

install::
	@mkdir -p Data/Logs
	@$(MAKE) -s install-githooks
	@$(MAKE) -s install-composer
	@$(MAKE) -s install-yarn
	@$(MAKE) -s flush

flush::
	@ddev composer flush

remove-artefacts:
	@ddev exec find ./DistributionPackages/ -type f -name '*.js.fusion' -delete
	@ddev exec find ./DistributionPackages/ -type f -name '*.css.fusion' -delete

cleanup::
	@ddev composer cleanup:php
	@ddev yarn cleanup:node
	@$(MAKE) -s remove-artefacts

###############################################################################
#                                LINTING & QA                                 #
###############################################################################
lint-editorconfig::
	@echo "Lint .editorconfig"
	@ddev exec composer lint:editorconfig

lint-php::
	@echo "Lint PHP Sources".
	@ddev exec composer lint:php

lint-css::
	@echo "Lint CSS Sources"
	@ddev yarn lint:css

lint-js::
	@echo "Lint JavaScript Sources"
	@ddev yarn lint:js

lint::
	@$(MAKE) -s lint-editorconfig
	@$(MAKE) -s lint-php
	@$(MAKE) -s lint-css
	@$(MAKE) -s lint-js

###############################################################################
#                               FRONTEND BUILD                                #
###############################################################################
build::
	@ddev yarn build

watch::
	@ddev yarn watch

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
