#!/usr/bin/env bash
source .env
PROJECT_PATH=${PROJECT_PATH}
LARAVEL_VERSION=${LARAVEL_VERSION}

# Run in php container.
echo "Laravel version to install is $LARAVEL_VERSION ."
composer create-project laravel/laravel="$LARAVEL_VERSION" laravel-app --prefer-dist
shopt -s dotglob
mv -n laravel-app/* "$PROJECT_PATH"
shopt -u dotglob
rm -r laravel-app