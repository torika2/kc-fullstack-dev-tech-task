FROM php:8.3-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Install PDO and MySQL extensions
RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory
WORKDIR /var/www/html