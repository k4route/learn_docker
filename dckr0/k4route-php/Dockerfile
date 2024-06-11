FROM ubuntu:latest

MAINTAINER Fedor Chernyshev

RUN apt-get clean \
    && apt-get -y update \
    && apt-get install -y locales \
    && locale-gen en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8
ENV VAR MYVAR

RUN apt-get update \
    && apt-get install -y curl zip unzip git software-properties-common \
    ca-certificates lsb-release apt-transport-https \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends php8.3-fpm \
       php8.3-cli php8.3-mcrypt php8.3-gd php8.3-mysql npm \
       php8.3-pgsql php8.3-imap php-memcached php8.3-mbstring php8.3-xml php8.3-curl \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && mkdir /run/php \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD php-fpm.conf /etc/php/8.3/fpm/php-fpm.conf
ADD www.conf /etc/php/8.3/fpm/pool.d/www.conf

#EXPOSE 9000
CMD ["php-fpm8.3"]

