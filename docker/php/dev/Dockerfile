FROM php:8.0.9-fpm-alpine3.14

RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY . /var/www/html

EXPOSE 9000