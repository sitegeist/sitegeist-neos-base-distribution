#!/usr/bin/env bash

function fetchContainerIPs {
    echo ""
    echo -e "\e[96m\e[1mFetching Container IPs"

    export DOCKERWEBNAME=$(docker ps | grep -o ${COMPOSE_PROJECT_NAME}_${COMPOSE_WEBSERVER_NAME}_1.*)
    export DOCKERDBNAME=$(docker ps | grep -o ${COMPOSE_PROJECT_NAME}_${COMPOSE_DATABASE_NAME}_1.*)

    getDockerContainerIP ${DOCKERWEBNAME} WEB_IP
    getDockerContainerIP ${DOCKERDBNAME} DB_IP
}

# Returns the IP of a docker container
# pass name of docker-container as first parameter
# if the IP should be written to a variable pass variable name as second parameter
function getDockerContainerIP {
    local  __DockerIPVar=$2
    local  DockerIP=`docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $1`

    # If Docker Toolbox is used you can't access IP. You need to connect to DOCKER_HOST IP
    if [ ! -z "$DOCKER_HOST" ]; then
        local  DockerIP=`echo $DOCKER_HOST | cut -d: -f2 | cut -c3-`
    fi

    if [[ "$__DockerIPVar" ]]; then
        eval $__DockerIPVar="'$DockerIP'"
    else
        echo "$DockerIP"
    fi
}


# Checks if required functions are available
function checkRequirements {
    local REQ_CHECK=1
    local COMMANDS=("docker" "nc" "git" "gunzip" "ssh")
    local DOCKER_MIN="17.06.0"

    echo ""
    echo -e "\e[96m\e[1mChecking Requirements\e[39m"

    for COMMAND in "${COMMANDS[@]}"
    do
        echo -ne "${COMMAND}: "
        if [ ! -x "$(command -v ${COMMAND})" ]; then
            echo -e "\e[31mnot available\e[39m"
            REQ_CHECK=0
        else
            echo -e "\e[32mavailable\e[39m"
        fi
    done

    if [ ${REQ_CHECK} == 0 ]; then
        echo -e "\e[31mPlease install missing requirements\e[39m"
        exit 1
    fi

    local DOCKER_VERSION=$(docker --version | sed 's/[^0-9.]*\([0-9.]*\).*/\1/')
    compare_version ${DOCKER_MIN} ${DOCKER_VERSION}
    if [ $? == 1 ]; then
       echo -e "\e[31mYour Docker version is ${DOCKER_VERSION}. Minimum required is ${DOCKER_MIN}\e[39m"
        exit 1
    fi
}