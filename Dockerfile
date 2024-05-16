ARG PHP_VERSION=8.1
FROM php:${PHP_VERSION}-fpm-alpine

WORKDIR /app

RUN apk add --no-cache \
        curl \
        bash \
        git \
    ;

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN set -eux; \
    install-php-extensions \
        http \
		apcu \
		intl \
		opcache \
		zip \
        pdo \
        pdo_mysql \
    ;

COPY --link .docker/app.ini $PHP_INI_DIR/conf.d/

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"
COPY --from=composer/composer:2-bin --link /composer /usr/bin/composer

ENV APP_ENV=dev
