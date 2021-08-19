#!/usr/bin/env bash

## for Windows. use start command.
#start make exec-php-cmd CMD="php artisan serve"
#make exec-php-cmd CMD="npm run watch"

# for MacOS, Linux and Others. use GNU screen. see http://aperiodic.net/screen/start
make exec-php-cmd CMD="screen -c docker/screen/serve-on-split-screens"
