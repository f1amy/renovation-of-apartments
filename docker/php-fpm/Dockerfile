FROM php:7.3-fpm

RUN docker-php-ext-install pdo_mysql opcache

RUN apt-get update && apt-get install -y \
  --no-install-recommends \
  libmagickwand-dev \
  libmemcached-dev \
  zlib1g-dev \
  && rm -rf /var/lib/apt/lists/*

RUN pecl install imagick-3.4.4 \
  && pecl install memcached-3.1.3 \
  && pecl install xdebug-2.7.2

RUN docker-php-ext-enable xdebug imagick memcached
