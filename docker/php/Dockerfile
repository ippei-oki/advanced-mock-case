FROM php:8.3.7-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
  default-mysql-client \
  zlib1g-dev \
  libzip-dev \
  unzip \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  libwebp-dev \
  libxpm-dev \
  libmagickwand-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
  && docker-php-ext-install pdo_mysql zip gd \
  && pecl install imagick \
  && docker-php-ext-enable imagick \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www