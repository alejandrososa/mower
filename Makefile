# In order to help running the project with less intervention and dynamically,
# setting some variables to be used inside the makefile,
# some of them are to prefix commands specially for commands to be run inside a container

DOCKER_COMPOSE = docker-compose
PROJECT = "Kata EV."
COMPOSER ?= composer
PHP_CMD = php

# The php service defined in the docker-compose.yml
PHP_SERVICE = php

# the below line make sure the service name are prefixed with the folder name
COMPOSE_PROJECT_NAME ?= $(notdir $(shell pwd))

# Here the command is determined based on the environment
# I'm not using docker in production
ifeq ($(APP_ENV), prod)
	CMD :=
else
	CMD := docker-compose exec $(PHP_SERVICE)
endif

# If you type make in your cli, it will list all the available commands.
help:
	@ echo "Usage: make \<target\>\n"
	@ echo "Available targets:\n"
	@ cat Makefile | grep -oE "^[^: ]+:" | grep -oE "[^:]+" | grep -Ev "help|default|.PHONY"

# This will stop all containers services
container-stop:
	@echo "\n==> Stopping docker container"
	$(DOCKER_COMPOSE) stop

# This will remove all containers services
container-down:
	@echo "\n==> Removing docker container"
	$(DOCKER_COMPOSE) down

# Start the containers and build them every time this commands is called
container-up:
	@echo "\n==> Docker container building and starting ..."
	$(DOCKER_COMPOSE) up --build -d

# This is a shortcut command to stop and remove containers
tear-down: container-stop container-down

# This will run inside the api container to install all composer dependencies.
composer-install:
	@echo "\n==> Running composer install, runner $(RUNNER)"
	$(CMD) $(COMPOSER) install

# This will run tests
tests-unit:
	@echo "\n==> Running tests"
	$(CMD) $(PHP_CMD) vendor/bin/phpunit

# This will run tests
move-ev:
	@echo "\n==> Running Kata"
	$(CMD) $(PHP_CMD) bin/console kata:electronic-vehicle:move

run-app: container-up composer-install tests-unit move-ev