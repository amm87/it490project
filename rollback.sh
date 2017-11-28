#!/bin/sh


ls $HOME/bundles

echo "Which version would like you to rollback to?"
read Version


if [ -e $HOME/bundles/$Version ]
then
    
    sudo rm "/var/www/html/it490project"
    sudo ln -s $HOME/bundles/$Version "/var/www/html/it490project" 

    sudo service apache2 restart
    sudo service apache2 reload 
    
else 
    echo "The version $Version does not exist. Please try again."
    exit 
    
fi 
