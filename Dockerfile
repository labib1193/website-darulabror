FROM php:8.2-apache

# Install ekstensi PHP
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

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Copy .env jika belum ada (hindari error saat artisan jalan)
RUN cp .env.example .env

# Generate key agar artisan bisa jalan tanpa error
RUN composer install --no-dev --optimize-autoloader || true
RUN php artisan key:generate || true

# Hapus cache & optimize agar build clean
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true
RUN php artisan optimize || true

# Buat symbolic link ke storage
RUN php artisan storage:link || true

RUN mkdir -p storage/app public/storage bootstrap/cache

# Atur permission
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache public/storage /tmp

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Set folder public sebagai root Apache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
CMD ["apache2-foreground"]
