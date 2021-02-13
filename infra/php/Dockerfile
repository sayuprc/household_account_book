FROM amd64/php:8.0.1-apache

RUN apt-get update

RUN docker-php-ext-install pdo_mysql opcache

RUN pecl install xdebug 

RUN docker-php-ext-enable xdebug

