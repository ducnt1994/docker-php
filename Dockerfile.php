FROM php:7.4-fpm

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
libzip-dev \
zip \
libpq-dev \
libonig-dev \
libcurl4-openssl-dev \
libssl-dev \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev

# Install necessary PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli zip pcntl gd

# Install Redis extension
RUN pecl install -o -f redis \
&& rm -rf /tmp/pear \
&& docker-php-ext-enable redis

# Install MongoDB extension
RUN pecl install mongodb \
&& docker-php-ext-enable mongodb

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer