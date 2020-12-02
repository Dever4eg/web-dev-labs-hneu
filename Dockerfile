FROM php:7.4-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS libzip-dev zip curl composer

RUN docker-php-ext-install pdo_mysql bcmath zip

WORKDIR /var/www

COPY ./composer.json /var/www/composer.json
RUN composer install

COPY . /var/www
