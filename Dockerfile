FROM ubuntu:latest AS base
LABEL Maintainer="Harun Baris Bulut <baris.bulut@plusclouds.com>"
LABEL Description="Lightweight version of LEOv4"
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/*
RUN apt update
RUN apt upgrade -y
RUN apt install -y software-properties-common
RUN apt -y install --no-install-recommends wget gnupg ca-certificates -qq
RUN add-apt-repository -y ppa:ondrej/php
RUN apt update -y
RUN apt install -y php8.2\
    php8.2-cli\
    php8.2-common\
    php8.2-fpm\
    php8.2-mysql\
    php8.2-zip\
    php8.2-gd\
    php8.2-mbstring\
    php8.2-curl\
    php8.2-xml\
    php8.2-bcmath\
    php8.2-pdo \
    php8.2-bz2 \
    php8.2-curl \
    php8.2-dev \
    php8.2-igbinary \
    php8.2-intl \
    php8.2-opcache \
    php8.2-readline \
    php8.2-redis \
    php8.2-swoole \
    php8.2-pgsql \
    nano

RUN apt install -y nginx

# Copying the starter script
COPY ./.docker/start.sh /start.sh

# Configura nginx to run with php8.2-fpm
COPY ./.docker/nginx.conf /etc/nginx/nginx.conf

# Creating the working environment
WORKDIR /var/www
RUN rm * -Rf

COPY . /var/www

RUN chown www-data:www-data * -R

EXPOSE 80

CMD ["sh", "/start.sh"]
