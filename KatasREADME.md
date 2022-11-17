# Refactoring Kata

## Points to refactor

- [Step 1]Correction properties entities with setter and getter OOP
- [Step 2]Fix respository data layer type correct
- [Step 3]Update templateManager integrate with those oop instance in TemplateManager class and test class
- [Step 4]Enhancement run makefile
- [Step 5]Refactor unite test TemplateManager using extend testCase phpUnit test

#### Steps to run

- [Step 1]In Makefile change your path in folder varaible
- [Step 2]Go to projet root with cygwin if using windows
- [Step 3]$ make

You should be able seen vendor folder and composer.lock to be created

#### Steps to test

- [Step 1]Go to projet root with cygwin if using windows
- [Step 2]$./vendor/bin/phpunit --verbose tests

You should be able seen test result for TemplateManagerTest.php