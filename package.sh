#!/bin/sh


echo Name Package:
read packageName
echo Folder to zip:
read Zip

tar -czvf $packageName $Zip

scp $Zip/$packageName anthony@192.168.1.151:/home/anthony/Bundles