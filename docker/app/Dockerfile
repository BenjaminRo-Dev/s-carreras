FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    libpq-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql bcmath zip gd opcache \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia el código al contenedor
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]



# FROM php:8.3-fpm

# # Paquetes y extensiones necesarias
# RUN apt-get update && apt-get install -y \
#     git unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
#     libpq-dev \
#  && docker-php-ext-install pdo pdo_pgsql bcmath zip

# # Composer
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www/html

# CMD ["php-fpm"]
