FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    npm \
    curl \
    bash \
    nano \
    $PHPIZE_DEPS \
    libzip-dev \
    libxml2-dev \
    icu \
    icu-dev \
    mysql-client \
    && docker-php-ext-install zip

RUN apk add libpng-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    zip \
    soap \
    bcmath \
    exif

RUN npm install -g npm

