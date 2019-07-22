#!/usr/bin/env bash

source DomainScripts/project.env.makefile
source DomainScripts/manage-etc-hosts.sh

#### remove domain to etc/hosts ####

DOMAIN=$PROJECT_ELASTICSEARCH_HOSTNAME
remove

echo ""