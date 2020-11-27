FROM php:7.4-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS libzip-dev zip curl composer

RUN docker-php-ext-install pdo_mysql bcmath zip

COPY . /var/www

WORKDIR /var/www
