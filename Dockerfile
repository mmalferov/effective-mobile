FROM php:8.4-fpm

# USER root

# RUN rm -f /var/lib/apt/lists/lock && \
#     rm -f /var/cache/apt/archives/lock && \
#     rm -f /var/lib/dpkg/lock*

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
    zip \
    libonig-dev \
    libicu-dev \
    # icu-devtools \
    nano \
    && \
    # echo "en_US.UTF-8 UTF-8" >> /etc/locale.gen && \
    # locale-gen && \
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

# USER www-data
