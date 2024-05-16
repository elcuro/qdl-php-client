IMAGE_NAME = qdl

# Executables (local)
DOCKER_RUN = docker run -it --user 1000:1000  --mount type=bind,source=.,target=/app $(IMAGE_NAME)

# Docker containers
PHP_CONT = $(DOCKER_COMP) exec php
REDIS_CONT = $(DOCKER_COMP) exec redis

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
SYMFONY  = $(PHP) bin/console

# Misc
.DEFAULT_GOAL = help
.PHONY        : help build up start down logs sh composer vendor sf cc

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

build:
	@docker image build -t $(IMAGE_NAME) .

terminal:
	@$(DOCKER_RUN) sh

install:
	@$(DOCKER_RUN) composer install

test:
	@$(DOCKER_RUN) composer dev:test:all

unit:
	@$(DOCKER_RUN) vendor/bin/phpunit --testsuite unit-tests

functional:
	@$(DOCKER_RUN) vendor/bin/phpunit --testsuite functional-tests
