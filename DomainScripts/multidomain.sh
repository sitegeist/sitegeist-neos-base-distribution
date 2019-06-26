#!/usr/bin/env bash

source DomainScripts//project.env.makefile
source DomainScripts//manage-etc-hosts.sh
source DomainScripts//tools.sh

#### fetch IP addresses of running containers ####
fetchContainerIPs

#### add database to Configuration/Development/Settings.yaml ####
removemulti
addmulti

echo ""
