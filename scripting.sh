#!/bin/sh


echo Destination IP:
read IP
echo Destination username: 
read username
echo Destination File Location:
read Location
echo Folder Package name:
read Folder
echo Folder to zip:
read Zip

tar -czvf $Folder $Zip