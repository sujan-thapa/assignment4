# Use an official PHP image with Apache
FROM php:7.4-apache

# Install dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Copy application files to the Apache document root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/
