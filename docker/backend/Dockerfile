FROM php:8.1-apache
EXPOSE 8080

RUN apt-get update && apt-get install -y --no-install-recommends \
    zip \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libicu-dev librabbitmq-dev libssl-dev;

RUN docker-php-ext-install \
    exif \
    zip \
    intl \
    mysqli \
    opcache \
    pdo \ 
    pdo_mysql;
 

RUN pecl install amqp

RUN docker-php-ext-enable amqp

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer > composer-setup.php && php composer-setup.php && mv composer.phar /usr/local/bin/composer;

COPY ./docker/backend/apache/apache.conf /etc/apache2/sites-available/000-default.conf

CMD /usr/sbin/apache2ctl -D FOREGROUND
