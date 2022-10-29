FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
        cron \
        # For php gd ext
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        # For php zip ext
        zlib1g-dev \
        libzip-dev \
        # For php ldap ext
        libldb-dev \
        libldap2-dev \
    	# For postgresql \
    	libpq-dev \
        # For memcached
        libmemcached-dev \
        # Install required packages
        default-mysql-client \
        locales \
        # For php composer
        unzip \
        # For Terminal
        git \
        #subversion \
        vim

RUN docker-php-ext-install pdo pgsql pdo_pgsql gd zip

# composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer


#timeZone
ENV TZ=Asia/Taipei
RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone

# RUN chmod 755 /init.sh
CMD php-fpm
