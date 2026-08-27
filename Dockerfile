# HandyHub Laravel App - Build v3
# ─── Stage 1: Build Vite Frontend Assets ───
FROM node:20-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build


# ─── Stage 2: PHP Laravel App ───
FROM php:8.2-apache

# Install system dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
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

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Copy built Vite assets from Stage 1
COPY --from=assets /app/public/build ./public/build

# ✅ Set ENV variables during build to prevent null errors
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV BROADCAST_CONNECTION=log
ENV REVERB_APP_ID=handyhub-app-id
ENV REVERB_APP_KEY=handyhub-app-key
ENV REVERB_APP_SECRET=handyhub-app-secret
ENV REVERB_HOST=localhost
ENV REVERB_PORT=8080
ENV REVERB_SCHEME=http

# Create .env from example
RUN cp -n .env.example .env || true

# Install Laravel PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Configure Apache to serve Laravel public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Enable Apache mod_rewrite (required for Laravel routes)
RUN a2enmod rewrite

# Generate app key
RUN php artisan key:generate --force

# Laravel writable directories
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD php artisan config:cache \
    && php artisan migrate --force \
    && php artisan serve --host=0.0.0.0 --port ${PORT:-8080}