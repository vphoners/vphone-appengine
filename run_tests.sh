#!/bin/bash


[ -f phpunit-4.8.9.phar ] || wget https://phar.phpunit.de/phpunit-4.8.9.phar

php phpunit-4.8.9.phar mail_to_from_sms/tests/test*
