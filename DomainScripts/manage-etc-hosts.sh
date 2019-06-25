#!/bin/bash

# PATH TO YOUR HOSTS FILE
ETC_HOSTS=/etc/hosts

function removehost {
    DOMAIN=$PROJECT_HOSTNAME
    remove
    DOMAIN=$COMPOSE_DATABASE_NAME
    remove
}


function remove {
    echo ""
    echo -e "\e[96m\e[1mRemove domain from hosts file\e[39m"
    if [ -n "$(grep $DOMAIN /etc/hosts)" ]
    then
        echo "$DOMAIN Found in your $ETC_HOSTS, Removing now...";
        sudo sed -i".bak" "/$DOMAIN/d" $ETC_HOSTS
    else
        echo "$DOMAIN was not found in your $ETC_HOSTS";
    fi
}

function addhost {
    IP=$WEB_IP
    DOMAIN=$PROJECT_HOSTNAME
    add

    IP=$DB_IP
    DOMAIN=$COMPOSE_DATABASE_NAME
    add
}


function add {
    echo ""
    echo -e "\e[96m\e[1mAdd domain to hosts file\e[39m"

    HOSTS_LINE="$IP\t$DOMAIN"
    if [ -n "$(grep DOMAIN /etc/hosts)" ]
        then
            echo "DOMAIN already exists : $(grep $DOMAIN $ETC_HOSTS)"
        else
            echo "Adding $DOMAIN to your $ETC_HOSTS";
            sudo -- sh -c -e "echo '$HOSTS_LINE' >> /etc/hosts";

            if [ -n "$(grep $DOMAIN /etc/hosts)" ]
                then
                    echo "$DOMAIN was added succesfully"
                    echo "$(grep $DOMAIN /etc/hosts)";
                else
                    echo "Failed to Add $DOMAIN, Try again!";
            fi
    fi
}
