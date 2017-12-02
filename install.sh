#!/bin/sh
running=1
while [ $running -eq 1 ]
do
    echo "Enter machine IP address to install to:"
    read ip_address

    if [ $ip_address = "stop" ]
    then
        running=0
    else
        ssh -t $ip_address "scp -r anthony@192.168.1.151:/home/anthony/bundles/$1 ~/bundles; 
        mkdir ~/bundles/$2;
        tar -xvzf ~/bundles/$1 -C ~/bundles/$2; 
        sudo rm /var/www/html/it490project;
        sudo ln -s ~/bundles/$2 '/var/www/html/it490project';
	sudo service apache2 restart;
	sudo service apache2 reload"
    fi
done




