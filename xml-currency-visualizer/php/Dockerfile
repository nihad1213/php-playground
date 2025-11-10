FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
        libpng libpng-dev \
        libjpeg-turbo libjpeg-turbo-dev \
        freetype-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install gd

WORKDIR /var/www/html