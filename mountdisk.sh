#!/bin/bash
mkfs.ext4 $1
mkdir $2
mount $1 $2
