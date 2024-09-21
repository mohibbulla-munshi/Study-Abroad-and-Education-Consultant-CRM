FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip
