# Gunakan image PHP + Apache + Composer
FROM php:8.2-apache

# Install ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip gd mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin semua file Laravel ke /var/www/html
COPY . /var/www/html

# Pindahkan index.php ke public/
WORKDIR /var/www/html

# Berikan permission
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Konfigurasi Apache agar pakai public sebagai root
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

RUN php artisan storage:link
RUN chmod -R 775 storage bootstrap/cache public/storage /tmp


EXPOSE 80
CMD ["apache2-foreground"]
