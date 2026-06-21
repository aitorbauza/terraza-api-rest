FROM php:8.3-apache

# FEATURE DOCKER - Configuració per contenidors Laravel + MySQL

# Instal·lar extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instal·lar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar document root
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Copiar fitxers
COPY . .

# Instal·lar dependències ignorant requisits de versió de PHP
RUN composer install --no-interaction --ignore-platform-req=php --ignore-platform-req=ext-fileinfo

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80