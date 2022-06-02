FROM php:8-fpm

# PHP config
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
# install composer (option 1)
# RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/local/bin/composer
# Install composer (option 2)
RUN set -x \
   && php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
   && php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') !== trim(file_get_contents('https://composer.github.io/installer.sig'))) { echo 'ERROR: Invalid installer signature' . PHP_EOL; unlink('/tmp/composer-setup.php'); exit(1); }" \
   && php /tmp/composer-setup.php --version=2.1.3 --install-dir=/usr/local/bin --filename=composer  \
   && rm -rf /tmp/composer-setup.php
# Install composer (option 3)
# COPY --from=composer:1 /usr/bin/composer /usr/local/bin/composer
# Set composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    libwebp-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    unzip \
    vim \
    nano \
    # install nodejs and npm
    && curl -sL https://deb.nodesource.com/setup_15.x | bash - \
    && apt-get install -y nodejs \
    # install yarn
    && apt-get install -y yarn \
    && apt-get install -y libpq-dev \
    && apt-get -y autoremove \
    # Clear cache
    && apt-get clean && rm -rf /var/lib/apt/lists/*
# Install extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql fileinfo zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd
RUN docker-php-ext-install pcntl
WORKDIR /var/www/html