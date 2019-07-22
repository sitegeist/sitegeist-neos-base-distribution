#!/bin/bash

function removehost {
    DOMAIN=$PROJECT_HOSTNAME
    remove
    DOMAIN=$PROJECT_DATABASE_HOSTNAME
    remove
}

function addhost {
    IP=$WEB_IP
    DOMAIN=$PROJECT_HOSTNAME
    add

    IP=$DB_IP
    DOMAIN=$PROJECT_DATABASE_HOSTNAME
    add
    changesettings
}

function changesettings {
    echo ""
    if [ -n "$(grep 'host:.*#dbhost' $CONFIGURATION_SETTINGS)" ]
    then
        echo "Changing database host from your $CONFIGURATION_SETTINGS";
        sed -i -e "s/host:.*#dbhost/host: $DOMAIN #dbhost/g" $CONFIGURATION_SETTINGS;
    else
        echo "Not changing your $CONFIGURATION_SETTINGS";
    fi
}

function elasticsettings {
    echo ""
    if [ -n "$(grep 'host:.*#elastic' $CONFIGURATION_SETTINGS)" ]
    then
        echo "Changing database host from your $CONFIGURATION_SETTINGS";
        sed -i -e "s/host:.*#elastic/host: $DOMAIN #elastic/g" $CONFIGURATION_SETTINGS;
    else
        echo "Not changing your $CONFIGURATION_SETTINGS";
    fi
}

function removemulti {
    DOMAIN=$PROJECT_MULTIDOMAIN_HOSTNAMES
    echo "Removing multidomains ($DOMAIN) from your $ETC_HOSTS";
    sudo sed -i".bak" "/$DOMAIN/d" $ETC_HOSTS
}

function addmulti {
    IP=$WEB_IP
    DOMAIN=$PROJECT_MULTIDOMAIN_HOSTNAMES
    HOSTS_LINE="$IP\t$DOMAIN"
    echo "Adding multidomains to your $ETC_HOSTS";
    echo "$IP   $DOMAIN";
    sudo -- sh -c -e "echo '$HOSTS_LINE' >> /etc/hosts";
}

function remove {
    echo ""
    echo -e "\e[95m\e[1mRemove domain from hosts file\e[39m"
    if [ -n "$(grep $DOMAIN /etc/hosts)" ]
    then
        echo "$DOMAIN Found in your $ETC_HOSTS, Removing now...";
        sudo sed -i".bak" "/$DOMAIN/d" $ETC_HOSTS
    else
        echo "$DOMAIN was not found in your $ETC_HOSTS";
    fi
}

function add {
    echo ""
    echo -e "\e[95m\e[1mAdd domain to hosts file\e[39m"

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
