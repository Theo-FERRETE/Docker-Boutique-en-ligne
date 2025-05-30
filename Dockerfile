FROM php:8.2-apache

# Installe les extensions nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Active le module Apache rewrite 
RUN a2enmod rewrite

# Configuration Apache pour autoriser .htaccess (important pour le rewrite)
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
