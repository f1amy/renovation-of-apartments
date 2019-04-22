FROM php:7.3.4-fpm

RUN apt-get update && apt-get install -y \
  libmagickwand-dev \
  libmemcached-dev \
  zlib1g-dev \
  --no-install-recommends && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
  && pecl install imagick-3.4.3 \
  && pecl install memcached-3.1.3 \
  && pecl install xdebug-2.7.1 \
  && docker-php-ext-install pdo pdo_mysql \
  && docker-php-ext-enable xdebug imagick memcached

CMD ["php"]
