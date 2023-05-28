FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    curl \
    git \
    zip \
    unzip

COPY . /www

WORKDIR /www

RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /www


