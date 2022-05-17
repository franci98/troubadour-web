#!/bin/bash
set -e
set -x

docker build --platform=linux/amd64 -t registry.koin.musiclab.si/ul-fri-lgm/troubadour:latest .
docker push registry.koin.musiclab.si/ul-fri-lgm/troubadour:latest
