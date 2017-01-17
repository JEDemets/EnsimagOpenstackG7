#!/bin/bash
if [ "$3" = "format" ]
then
	mkfs.ext4 $1
fi
mkdir $2
mount $1 $2
