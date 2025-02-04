FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    curl

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip pdo_mysql 

# Set up SSH directory
RUN mkdir -p /root/.ssh
WORKDIR /root/.ssh

# Install Composer
WORKDIR /tmp
COPY composer-setup.php .
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm composer-setup.php

# Install required PHP extensions
RUN docker-php-ext-configure gd --with-freetype
RUN docker-php-ext-install zip pdo_mysql gd

# Copy custom shell script
COPY cmd.sh .
RUN chmod u+x cmd.sh

# Set working directory
WORKDIR /var/www/html

# Set the default command to run your custom shell script
CMD ["bash","/tmp/cmd.sh"]
