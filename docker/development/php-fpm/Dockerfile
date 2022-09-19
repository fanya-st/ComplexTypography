FROM php:8.1-fpm

#RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN apt-get update
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libzip-dev
RUN apt-get install -y zip
RUN apt-get install -y libpq-dev
RUN apt-get install -y libmcrypt-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pgsql pdo_pgsql pdo_mysql mysqli
RUN docker-php-ext-install zip
RUN docker-php-ext-install calendar
RUN docker-php-source delete
#	&& docker-php-ext-configure gd --with-freetype --with-jpeg \


RUN export COMPOSER_ALLOW_SUPERUSER=1;

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#RUN composer install --prefer-source

WORKDIR /app

#RUN composer update --no-interaction
