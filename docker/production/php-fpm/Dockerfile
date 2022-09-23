FROM php:8.1-fpm

#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

ENV TZ=Europe/Moscow

RUN apt-get update
RUN apt-get install -y tzdata
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libzip-dev
RUN apt-get install -y zip
RUN apt-get install -y libpq-dev
RUN apt-get install -y libmcrypt-dev

RUN cp /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pdo_mysql mysqli
RUN docker-php-ext-install zip
RUN docker-php-ext-install calendar
RUN docker-php-source delete


RUN export COMPOSER_ALLOW_SUPERUSER=1;

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html
