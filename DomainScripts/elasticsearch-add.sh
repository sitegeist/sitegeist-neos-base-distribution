#!/usr/bin/env bash

source DomainScripts/project.env.makefile
source DomainScripts/manage-etc-hosts.sh
source DomainScripts/tools.sh

#### fetch IP addresses of running containers ####
fetchElasticsearchIP

IP=$ELASTIC_IP
DOMAIN=$PROJECT_ELASTICSEARCH_HOSTNAME
remove
add
elasticsettings

echo ""
