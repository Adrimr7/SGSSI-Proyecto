FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
RUN sudo cp security.conf /etc/apache2/conf-enabled/security.conf
