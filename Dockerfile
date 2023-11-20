FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

RUN a2enmod headers
RUN a2enmod rewrite
RUN service apache2 restart
#RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/
#RUN cp /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/
