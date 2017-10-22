FROM php:7.1.10-apache

RUN apt-get update && apt-get install -y \
  libxml2-dev \
  && docker-php-ext-install pdo pdo_mysql soap

COPY . /var/www/html/

RUN chmod -R a+w /var/www/html/skins/default/templates_c
