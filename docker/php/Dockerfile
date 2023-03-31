FROM php:7.4.28-apache
RUN apt-get update && \
      apt-get install -y curl \
      redis-server \
      git \
      zip \
      wget \
      vim \
      && docker-php-ext-install pdo pdo_mysql bcmath \
      && pecl install redis \
      && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer

RUN chown -R www-data:www-data /var/www/html

COPY --chown=www-data:www-data apache2/sites-available/. /etc/apache2/sites-available/.

RUN a2dissite 000-default.conf &&\
   a2ensite laravel.conf &&\
   a2enmod rewrite &&\
   service apache2 restart

# RUN cd /var/www/html &&\ /usr/local/bin/composer install