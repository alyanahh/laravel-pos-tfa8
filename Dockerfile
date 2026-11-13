
# ==========================================
# STAGE 1: BUILD FRONTEND
# ==========================================
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm ci

COPY . .

RUN npm run build

# Verify Vite manifest exists
RUN test -f public/build/manifest.json


# ==========================================
# STAGE 2: LARAVEL APPLICATION
# ==========================================
FROM php:8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        unzip \
        libzip-dev \
        libonig-dev \
        libpq-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        mbstring \
        zip \
        pdo_pgsql \
        gd \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy Laravel source
COPY . .

# Copy compiled Vite assets
COPY --from=frontend /app/public/build /var/www/html/public/build

# Verify assets in final image
RUN test -f public/build/manifest.json

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=file \
    CACHE_STORE=file \
    QUEUE_CONNECTION=sync \
    FILESYSTEM_DISK=public \
    DB_CONNECTION=pgsql \
    PORT=10000

# Install Laravel dependencies
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --optimize-autoloader

# Configure Apache
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && sed -ri 's/<VirtualHost \*:80>/<VirtualHost *:10000>/' /etc/apache2/sites-available/000-default.conf \
    && sed -ri 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && printf '\n<Directory /var/www/html/public>\nOptions FollowSymLinks\nAllowOverride All\nRequire all granted\nDirectoryIndex index.php\n</Directory>\n' >> /etc/apache2/apache2.conf \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD ["bash", "-lc", "set -e; php artisan migrate --force; php artisan storage:link || true; chown -R www-data:www-data storage bootstrap/cache; exec apache2-foreground"]
