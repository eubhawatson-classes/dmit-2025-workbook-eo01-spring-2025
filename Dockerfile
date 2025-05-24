FROM php:8.2-apache

# Enable mod_autoindex (it's included by default in this image)
RUN a2enmod rewrite

# Add PDO extensions
RUN docker-php-ext-install pdo pdo_mysql

# Replace default config with one that allows directory listing
COPY apache-dirlist.conf /etc/apache2/sites-enabled/000-default.conf