FROM polinux/httpd-php
COPY ./src /var/www/html
WORKDIR /etc
COPY ./php.ini .
RUN mkdir -p /data/tmp/php/sessions
RUN chmod -R 777 /data/tmp/php/sessions
