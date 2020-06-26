FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
  --no-install-recommends \
  libicu-dev \
  libmagickwand-dev \
  libmemcached-dev \
  zlib1g-dev \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install intl pdo_mysql opcache

RUN pecl install imagick-3.4.4 \
  && pecl install memcached-3.1.3 \
  && pecl install xdebug-2.7.2

RUN docker-php-ext-enable imagick memcached xdebug
