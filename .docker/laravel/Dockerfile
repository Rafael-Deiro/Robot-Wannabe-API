FROM php:8-fpm-alpine

COPY composer.lock composer.json /var/www/rwbapp/

WORKDIR /var/www/rwbapp/

RUN apk update && \
    apk add git zip unzip


COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions bcmath gd intl opcache pdo_pgsql redis zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN addgroup -g 1000 -S robotland && \
    adduser -u 1000 -D -S -G robotland mroboto

COPY . /var/www/rwbapp
COPY --chown=mroboto:robotland . /var/www/rwbapp

USER mroboto

EXPOSE 9000
CMD ["php-fpm"]
