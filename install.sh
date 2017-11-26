#!/bin/sh
echo "Enter IP:"
read Address
echo "Enter source path:"
read Source
echo "Enter file name:"
read FileName
echo "Enter version:"
read Version

if ! [ -e $HOME/bundles ]
then
mkdir $HOME/bundles
fi

if ! [ -e $HOME/bundles/website-$Version ]
then
mkdir $HOME/bundles/website-$Version
fi

scp -r $Address:$Source/$FileName $HOME/bundles
tar -xvzf $HOME/bundles/$FileName -C $HOME/bundles/website-$Version


if [ -e "/var/www/html/it490project" ]
then
sudo rm "/var/www/html/it490project" 

sudo ln -s $HOME/bundles/website-$Version "/var/www/html/it490project" 

fi

sudo service apache2 restart

