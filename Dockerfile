FROM php:7.0-apache
# COPY ./src /var/www/html
# COPY ./php.ini /etc/
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update -y && apt-get install -y telnet
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer

WORKDIR /var/www/html
RUN composer install