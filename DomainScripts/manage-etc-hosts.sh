#!/bin/bash

# PATH TO YOUR HOSTS FILE
ETC_HOSTS=/etc/hosts

function removehost {
    echo ""
    echo -e "\e[96m\e[1mRemove domain from hosts file\e[39m"
    if [ -n "$(grep $PROJECT_HOSTNAME /etc/hosts)" ]
    then
        echo "$PROJECT_HOSTNAME Found in your $ETC_HOSTS, Removing now...";
        sudo sed -i".bak" "/$PROJECT_HOSTNAME/d" $ETC_HOSTS
    else
        echo "$PROJECT_HOSTNAME was not found in your $ETC_HOSTS";
    fi
}

function addhost {
    echo ""
    echo -e "\e[96m\e[1mAdd domain to hosts file\e[39m"

    HOSTS_LINE="$WEB_IP\t$PROJECT_HOSTNAME"
    if [ -n "$(grep $PROJECT_HOSTNAME /etc/hosts)" ]
        then
            echo "$PROJECT_HOSTNAME already exists : $(grep $PROJECT_HOSTNAME $ETC_HOSTS)"
        else
            echo "Adding $PROJECT_HOSTNAME to your $ETC_HOSTS";
            sudo -- sh -c -e "echo '$HOSTS_LINE' >> /etc/hosts";

            if [ -n "$(grep $PROJECT_HOSTNAME /etc/hosts)" ]
                then
                    echo "$PROJECT_HOSTNAME was added succesfully"
                    echo "$(grep $PROJECT_HOSTNAME /etc/hosts)";
                else
                    echo "Failed to Add $PROJECT_HOSTNAME, Try again!";
            fi
    fi
}
