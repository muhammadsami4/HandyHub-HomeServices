# --- Stage 1: Build frontend assets (Vite) ---
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: PHP app ---
FROM php:8.2-cli

# System deps + PHP extensions Laravel commonly needs
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip gd mbstring xml \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
# Bring in the built frontend assets from stage 1
COPY --from=assets /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel needs these writable
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Run migrations then start the built-in server on Render's assigned port
CMD php artisan config:cache \
    && php artisan migrate --force \
    && php artisan serve --host 0.0.0.0 --port ${PORT:-8080}