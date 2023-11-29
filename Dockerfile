#===============================================================================================================
# Getting base image
#===============================================================================================================
FROM ubuntu:20.04

WORKDIR /projeto/

ARG DEBIAN_FRONTEND=noninteractive

#===============================================================================================================
# Installing the necessary libraries
#===============================================================================================================

# Install Ubuntu dependencies, NODEJS, and PHP
RUN apt-get update && \
    apt-get install -y curl software-properties-common && \
    yes | apt-get install -y curl && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash && \
    apt-get update && \
    apt-get install -y nodejs && \
    add-apt-repository ppa:ondrej/php && \
    yes | apt-get install wget -y curl php8.1-xdebug php8.1-cli php8.1-curl php8.1-gd php8.1-mbstring php8.1-mcrypt php8.1-pgsql php8.1-redis php8.1-xdebug php8.1-xml php8.1-zip libapache2-mod-php8.1 php-pear apache2 libapache2-mod-php8.1 zlib1g-dev libzip-dev unzip zip && \
    rm -rf /var/lib/apt/lists/*

# Copy apache settings
COPY /config/apache/apache2.conf /etc/apache2/apache2.conf
COPY /config/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY /config/xdebug/20-xdebug.ini /etc/php/8.1/apache2/conf.d/20-xdebug.ini

RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#===============================================================================================================
# Create user and setting permissions
#===============================================================================================================

RUN adduser --disabled-password --gecos "" barreto && \
    usermod -aG sudo barreto

EXPOSE 8000
