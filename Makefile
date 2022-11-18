# specify the default target, if not "all"
default: test

.PHONY: test
test:
	@make phpunit --no-print-directory

.PHONY: phpunit
phpunit:
	@echo 'PHPUnit Tests'
	./vendor/phpunit/phpunit/phpunit \
		--bootstrap ./tests/phpunit_bootstrap.php \
		--configuration ./tests/phpunit.xml.dist \
		./tests
