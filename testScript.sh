#!/bin/sh
echo "Enter IP:"
read Address
echo "Enter source path:"
read Source
echo "Enter name of file on source computer:"
read SourceFile
echo "Enter destination path:"
read Dest
echo "Enter folder name to extract to:"
read FolderName

scp -r $Address:$Source/$SourceFile $Dest
mkdir $Dest/$FolderName
tar -xvzf $Dest/$SourceFile -C $Dest/$FolderName
sudo rm "/var/www/html/it490project" 
sudo ln -s $Dest/$FolderName "/var/www/html/it490project" 
