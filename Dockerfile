FROM php:8.4-apache

# This installs all ths things we need that aren't included by default: OS packages, GD dependencies, PDO, & mysqli.
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      curl \
      zip unzip \
      git \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libpng-dev \
      libwebp-dev \
      libavif-dev \
      libaom-dev \
      libdav1d-dev \
      libyuv-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
      --with-webp \
      --with-avif \
    && docker-php-ext-install -j"$(nproc)" \
      gd \
      pdo_mysql \
      mysqli \
    && rm -rf /var/lib/apt/lists/*

# Enables URL rewriting (i.e. mod_autoindex).
RUN a2enmod rewrite

# Replaces default config with ours (one that allows directory listing).
COPY apache-dirlist.conf /etc/apache2/sites-enabled/000-default.conf