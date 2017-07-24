FROM php:7.1-fpm-alpine

RUN apk --update add \
       zlib-dev postgresql-dev libxml2-dev libmcrypt-dev icu-dev \
    && docker-php-ext-install \
       zip pdo_pgsql soap intl mcrypt iconv

RUN apk add \
      curl git subversion openssh openssl mercurial tini bash

RUN apk add --no-cache \
            xvfb \
            ttf-freefont \
            fontconfig \
            dbus \
            zlib-dev \
            tar

RUN apk add --update --no-cache \
    libgcc libstdc++ libx11 glib libxrender-dev libxext libintl \
    libcrypto1.0 libssl1.0 \
    ttf-dejavu ttf-droid ttf-freefont ttf-liberation ttf-ubuntu-font-family

RUN apk add --update freetype-dev libjpeg-turbo-dev libpng-dev gd \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" gd

ENV PATH "/composer/vendor/bin:$PATH"
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer --no-ansi --version=1.4.1

COPY ./bin/wkhtmltopdf /bin
RUN chmod +x /bin/wkhtmltopdf

RUN echo $'#!/usr/bin/env sh\n\
Xvfb :0 -screen 0 1024x768x24 -ac +extension GLX +render -noreset & \n\
DISPLAY=:0.0 /bin/wkhtmltopdf $@ \n\
killall Xvfb\
' > /usr/bin/wkhtmltopdfx && chmod +x /usr/bin/wkhtmltopdfx

WORKDIR /var/www
