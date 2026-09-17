FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/Inventario_apimax

RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite \
    && sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" \
        /etc/apache2/sites-available/*.conf \
        /etc/apache2/apache2.conf \
        /etc/apache2/conf-available/*.conf
