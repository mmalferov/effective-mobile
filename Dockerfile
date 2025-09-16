FROM php:8.4-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
    zip \
    libonig-dev \
    libicu-dev \
    nano \
    && \
    docker-php-ext-install \
    pdo_mysql \
    zip \
    opcache \
    mbstring \
    intl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/effectivemobile

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

USER www-data
