FROM composer:1.8 AS build

RUN composer global require hirak/prestissimo

#VOLUME /tmp

WORKDIR /build

COPY . /build

RUN composer install

FROM php:7.3-fpm

RUN docker-php-ext-install pdo_mysql opcache

RUN apt-get update && apt-get install -y \
  --no-install-recommends \
  locales \
  libmagickwand-dev \
  libmemcached-dev \
  zlib1g-dev \
  && rm -rf /var/lib/apt/lists/*

RUN echo "ru_RU.UTF-8 UTF-8" >> /etc/locale.gen
RUN locale-gen

RUN pecl install imagick-3.4.4 \
  && pecl install memcached-3.1.3

RUN docker-php-ext-enable imagick memcached

COPY /docker/php-fpm/config/general.ini /usr/local/etc/php/conf.d

COPY --from=build /build /var/www/html

#VOLUME /var/www/html/web/assets
