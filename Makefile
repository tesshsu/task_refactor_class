FOLDER=c://Users/Livmeds10/Documents/task_refactor_class
COMPOSER = docker run --rm -it -v $(FOLDER):/app -w /app -u $$(id -u):$$(id -g) composer:1.6
PHP = docker run --rm -it -v $(FOLDER):/app -w /app -u $$(id -u):$$(id -g) php:7.2

composer.lock: composer.json
	$(COMPOSER) composer update --prefer-lowest
	touch composer.lock

dump-autoload: composer.json
	$(COMPOSER) composer dump-autoload -o

vendor: composer.lock
	$(COMPOSER) composer install
	touch vendor

example: vendor
	$(PHP) php example/example.php

test: vendor
	$(PHP) php vendor/bin/phpunit --verbose tests

