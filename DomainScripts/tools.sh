#!/usr/bin/env bash

function fetchContainerIPs {
    echo ""
    echo -e "\e[96m\e[1m### Fetching Container IPs"

    export DOCKERWEBNAME=$(docker ps | grep -o ${COMPOSE_PROJECT_NAME}_${COMPOSE_WEBSERVER_NAME}_1.*)
    export DOCKERDBNAME=$(docker ps | grep -o ${COMPOSE_PROJECT_NAME}_${COMPOSE_DATABASE_NAME}_1.*)

    getDockerContainerIP ${DOCKERWEBNAME} WEB_IP
    getDockerContainerIP ${DOCKERDBNAME} DB_IP
}

function fetchElasticsearchIP {
    echo ""
    echo -e "\e[96m\e[1m### Fetching Elasticsearch IP"
    export DOCKERNAME=$(docker ps | grep -o ${COMPOSE_PROJECT_NAME}_${COMPOSE_ELASTICSEARCH_NAME}_1.*)
    getDockerContainerIP ${DOCKERNAME} ELASTIC_IP
}

function fetchMailhogIP {
    echo ""
    echo -e "\e[96m\e[1m### Fetching Mailhog IP"
    export DOCKERNAME=$(docker ps | grep -o ${COMPOSE_PROJECT_NAME}_${COMPOSE_MAILHOG_NAME}_1.*)
    getDockerContainerIP ${DOCKERNAME} MAILHOG_IP
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
