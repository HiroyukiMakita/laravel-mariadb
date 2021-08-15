#########################################################
# imports
#########################################################

include .env
PHP_PROJECT_ROOT := ${PHP_PROJECT_ROOT}

#########################################################
# variables
#########################################################

COMPOSE := docker-compose
BUILD := $(COMPOSE) build --no-cache
UP := $(COMPOSE) up -d
DOWN := $(COMPOSE) down
EXEC = $(COMPOSE) exec $(CONTAINER) bash $(ARG)
CONTAINER =
ARG =

# docker services (container name)
PHP := php
DB := db

#########################################################
# make commands
#########################################################

init:
	@make build up laravel install-admin-lte

build:
	@$(BUILD)

laravel:
	$(eval CONTAINER := $(PHP))
	$(eval ARG := -c "\
	cd $(PHP_PROJECT_ROOT)/docker && \
	bash shell/laravel-installer.sh\
	")
	@$(EXEC)

install-admin-lte:
	$(eval CONTAINER := $(PHP))
	$(eval ARG := -c "\
	cd $(PHP_PROJECT_ROOT) && \
	composer require jeroennoten/laravel-adminlte && \
	php artisan adminlte:install\
	")
	@$(EXEC)

up:
	@$(UP)

exec-php:
	$(eval CONTAINER := $(PHP))
	$(eval ARG := -c "cd $(PHP_PROJECT_ROOT) && bash")
	@$(EXEC)

serve:
	@bash shell/serve.sh

serve-laravel:
	@make exec-php-cmd CMD="php artisan serve"

serve-ui:
	@make exec-php-cmd CMD="npm run watch"

exec-php-cmd:
	$(eval CONTAINER := $(PHP))
	$(eval ARG := -c "cd $(PHP_PROJECT_ROOT) && ${CMD}")
	@$(EXEC)

exec-db:
	$(eval CONTAINER := $(DB))
	@$(EXEC)

down:
	@$(DOWN)

remove:
	@$(DOWN) --rmi all --volumes --remove-orphans
