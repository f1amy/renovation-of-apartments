FROM php:7.3-fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y \
  --no-install-recommends \
  libmagickwand-dev \
  libmemcached-dev \
  zlib1g-dev

RUN apt-get clean && \
  rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN pecl install imagick-3.4.3 \
  && pecl install memcached-3.1.3 \
  && pecl install xdebug-2.7.1

RUN docker-php-ext-enable xdebug imagick memcached
