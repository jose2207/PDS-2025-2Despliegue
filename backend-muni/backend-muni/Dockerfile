# Imagen base con PHP 8.2 y extensiones necesarias
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev zip unzip \
    libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mbstring pdo_mysql bcmath zip exif pcntl

# Instalar Composer desde imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear directorio de trabajo
WORKDIR /var/www

# Copiar los archivos del proyecto al contenedor
COPY . .

# Instalar dependencias de Laravel (Composer)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permisos para carpetas de caché y logs
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer el puerto PHP-FPM
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]
