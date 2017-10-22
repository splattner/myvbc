FROM php:7.1.10-apache
MAINTAINER Sebastian Plattner <sebastian.plattner@gmail.com>

ENV PORT 8080
ENTRYPOINT []
CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground


RUN apt-get update && apt-get install -y \
  libxml2-dev \
  && docker-php-ext-install pdo pdo_mysql soap

COPY . /var/www/html/

EXPOSE $PORT

RUN chmod -R a+w /var/www/html/skins/default/templates_c
