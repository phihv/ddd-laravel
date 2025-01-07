FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    redis-tools \
    vim \
    yarn && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd xml zip iconv

# Install xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Cài đặt Redis extension (phpredis)
RUN pecl install redis \
    && docker-php-ext-enable redis
#    && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini


# Set working directory
WORKDIR /var/www/html/repo

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
