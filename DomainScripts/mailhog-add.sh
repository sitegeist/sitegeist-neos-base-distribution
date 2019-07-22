#!/usr/bin/env bash

source DomainScripts/project.env.makefile
source DomainScripts/manage-etc-hosts.sh
source DomainScripts/tools.sh

#### fetch IP addresses of running containers ####
fetchMailhogIP

IP=$MAILHOG_IP
DOMAIN=$PROJECT_MAILHOG_HOSTNAME
remove
add

echo ""
echo -e "\e[93m\e[1mhttp://$DOMAIN:8025\e[39m"
echo ""
