FROM php:7.3-fpm

RUN apt-get update
RUN apt-get install -y curl git zip

RUN docker-php-ext-install pdo_mysql mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# COPY ./project/ /var/www/html/

CMD ["php-fpm"]
WORKDIR /var/www/html