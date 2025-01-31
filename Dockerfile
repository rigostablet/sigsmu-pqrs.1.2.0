FROM webdevops/php-nginx:8.2-alpine
ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISMOD=bz2,calendar,exiif,ffi,intl,gettext,ldap,mysqli,imap,pdo_pgsql,pgsql,soap,sockets,sysvmsg,sysvsm,sysvshm,shmop,xsl,zip,apcu,vips,yaml,imagick,mongodb,amqp
WORKDIR /app

COPY . .
RUN composer install --no-interaction -o --no-dev

# Configuración de Git
RUN git config --global --add safe.directory /app

RUN php artisan optimize
RUN php artisan storage:link

# Limpiar cachés y permisos
RUN chmod -R 775 /app/storage
RUN chmod -R 775 /app/bootstrap/cache

# -------------------------
# --- Sección para Vite ---
# Instalar Node.js y npm
RUN apk add --no-cache nodejs npm

# Copiar y construir dependencias de Vite
COPY package.json ./
RUN npm install

# Limpiar dependencias de desarrollo (opcional)
RUN npm prune --production

# Varios
RUN chown -R application:application .

RUN echo "* * * * * php /app/artisan schedule:run >> /dev/null 2>&1" >> /etc/crontabs/root
