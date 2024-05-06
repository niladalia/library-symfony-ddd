FROM php:8.3-fpm-alpine

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ git bash icu-dev libzip-dev rabbitmq-c rabbitmq-c-dev linux-headers zip unzip supervisor vim --force-missing-repositories
    
COPY .docker/php/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

COPY .docker/xdebug-config.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN docker-php-ext-install \
    pdo pdo_mysql 

RUN pecl install apcu-5.1.23 && pecl install amqp-2.1.1 && pecl install xdebug-3.3.0

RUN docker-php-ext-enable amqp apcu xdebug

RUN ln -snf /usr/share/zoneinfo/Europe/Madrid /etc/localtime && echo Europe/Madrid > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', Europe/Madrid > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

WORKDIR /var/www/librarify

COPY . .

RUN mkdir -p /etc/supervisor
RUN mkdir -p /etc/conf.d
RUN mkdir -p /var/log/supervisor
RUN touch /var/www/xdebug.logs
COPY .docker/supervisord.conf /etc/supervisor/supervisord.conf
COPY .docker/messenger-worker.conf /etc/supervisor/conf.d/messenger-worker.conf

#ENV COMPOSER_ALLOW_SUPERUSER=1

RUN chmod -R 777 /var/www/librarify/public/storage/default/
