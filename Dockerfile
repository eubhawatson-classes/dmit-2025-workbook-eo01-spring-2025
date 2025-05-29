FROM php:8.4-apache

# install OS packages & enable PHP extensions
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      curl \
      zip unzip \
      git \
    && docker-php-ext-install \
      pdo_mysql \
      mysqli \
    && rm -rf /var/lib/apt/lists/*

# Enable mod_autoindex (it's included by default in this image)
RUN a2enmod rewrite

# Replace default config with one that allows directory listing
COPY apache-dirlist.conf /etc/apache2/sites-enabled/000-default.conf