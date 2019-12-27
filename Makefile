.PHONY: pull help


pull: ## Pull all svn applications
	@/bin/bash bash/pullappli.bash

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "$(PRIMARY_COLOR)%-15s$(NO_COLOR) %s\n", $$1, $$2}'


vendor: composer.json
	@composer install
