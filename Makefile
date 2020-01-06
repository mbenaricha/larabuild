.PHONY: dev stop-dev help install test update
.DEFAULT_GOAL = help

COM_COLOR       = \033[0;34m
PRIMARY_COLOR   = \033[0;36m
SUCCESS_COLOR   = \033[0;32m
DANGER_COLOR    = \033[0;31m
WARNING_COLOR   = \033[0;33m
NO_COLOR        = \033[m

php := docker-compose run --rm php php
docker_php := docker-compose run --rm php
composer := docker-compose run --rm php composer
npm := docker-compose run node npm

dev: install ## Run the dev server
	@echo "Start development server on $(PRIMARY_COLOR)http://localhost:8000$(NO_COLOR)"
	@docker-compose up -d

stop-dev: install ## Stop the dev server
	@echo "Stop development server on $(PRIMARY_COLOR)http://localhost:8000$(NO_COLOR)"
	@docker-compose down

help: ## Display this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "$(PRIMARY_COLOR)%-15s$(NO_COLOR) %s\n", $$1, $$2}'

install: vendor node_modules ## Install the application

test: install ## Run the tests of the application
	@$(docker_php) vendor/bin/phpunit

update: ## Update the application
	@$(composer) update
	@$(npm) install

vendor: composer.json
	@$(composer) install

node_modules: package.json
	@$(npm) install
