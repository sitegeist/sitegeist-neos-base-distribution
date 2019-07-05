#!/usr/bin/env bash

source DomainScripts/project.env.makefile
source DomainScripts/manage-etc-hosts.sh

#### remove domain to etc/hosts ####
removehost

echo ""