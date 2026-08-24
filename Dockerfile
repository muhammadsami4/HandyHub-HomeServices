# --- Stage 1: Build frontend assets (Vite) ---
FROM node:20-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build


# --- Stage 2: PHP app ---
FROM php:8.2-cli

# System dependencies + PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    gd \
    mbstring \
    xml \
    && rm -rf /var/lib/apt/lists/*


# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Copy built Vite assets
COPY --from=assets /app/public/build ./public/build


# Install Laravel dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction


# Laravel writable directories
RUN chmod -R 775 storage bootstrap/cache


EXPOSE 8080


# Start Laravel
CMD php artisan config:cache \
    && php artisan migrate --force \
    && php artisan serve --host=0.0.0.0 --port ${PORT:-8080}