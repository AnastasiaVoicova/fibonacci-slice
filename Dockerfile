FROM php:8.1-fpm

RUN apt-get update && apt-get install -y nginx supervisor redis
RUN pecl install redis && docker-php-ext-enable redis
RUN rm /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

COPY default.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf
COPY ./supervisor.conf /etc/supervisor/conf.d/supervisord.conf
COPY . /var/www/html

RUN chmod 777 -R /var/www/html/storage/
RUN chmod 777 -R /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
