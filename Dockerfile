FROM webdevops/php-nginx:8.2-alpine 
ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISMOD=bz2,calendar,exiif,ffi,intl,gettext,ldap,mysqli,imap,pdo_pgsql,pgsql,soap,sockets,sysvmsg,sysvsm,sysvshm,shmop,xsl,zip,apcu,vips,yaml,imagick,mongodb,amqp
WORKDIR /app

COPY composer.json ./
COPY composer.lock ./
COPY . .
RUN composer install --no-interaction -o --no-dev

RUN php artisan optimize
RUN php artisan storage:link

# Limpiar cachés y permisos
RUN chmod -R 777 /app/storage
RUN chmod -R 777 /app/bootstrap/cache
RUN chown -R application:application .

RUN echo "* * * * * php /app/artisan schedule:run >> /dev/null 2>&1" >> /etc/crontabs/root
