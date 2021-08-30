FROM polinux/httpd-php
COPY ./src /var/www/html

FROM composer
WORKDIR /var/www/html
RUN  composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist