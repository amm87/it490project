#!/bin/sh

running=1
while [ $running -eq 1 ]
do
    echo "Enter IP address of a server to rollback:"
    read ip_address
    
    if [ $ip_address = "stop" ]
    then
        running=0
    else
        ssh -t $ip_address "ls ~/bundles"
        echo "Which version would like you to rollback to?"
        read version
        if [ $version = "stop" ]
        then 
            running=0
        else
            ssh -t $ip_address "sudo rm /var/www/html/it490project;
            sudo ln -s ~/bundles/$version /var/www/html/it490project;
            sudo service apache2 restart;
            sudo service apache2 reload;"
        fi
    fi
done
