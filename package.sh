#!/bin/sh


echo Name Package:
read packageName
echo Folder to zip:
read Zip

tar -czvf /tmp/$packageName .

scp /tmp/$packageName anthony@192.168.1.151:/home/anthony/bundles