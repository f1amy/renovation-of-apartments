FROM php:7.3-fpm-alpine

COPY --from=mlocati/php-extension-installer \
  /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions intl pdo_mysql opcache \
  imagick memcached xdebug
