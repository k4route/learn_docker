FROM ubuntu:latest

MAINTAINER Fedor Chernyshev

RUN apt-get clean \
    && apt-get -y update \
    && apt-get install -y locales \
    && locale-gen en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

RUN apt-get update \
    && apt-get install -y curl zip unzip git software-properties-common \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends php8.1-fpm \
       php8.1-cli php8.1-mcrypt php8.1-gd php8.1-mysql \
       php8.1-pgsql php8.1-imap php-memcached php8.1-mbstring php8.1-xml php8.1-curl \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && mkdir /run/php \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD php-fpm.conf /etc/php/8.1/fpm/php-fpm.conf
ADD www.conf /etc/php/8.1/fpm/pool.d/www.conf

EXPOSE 9000
CMD ["php-fpm8.1"]
