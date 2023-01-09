FROM debian:bullseye-slim AS builder
ENV DEBIAN_FRONTEND=noninteractive
ENV PHP_VERSION=8.2

# Update OS
RUN apt-get update && apt-get dist-upgrade -y

# Install dependencies
RUN apt-get -y install apt-transport-https lsb-release ca-certificates curl gnupg2 apt-utils git sudo zip socat zstd neovim

# Add php repo keys
RUN curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg && sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' && apt-get update && apt-get dist-upgrade -y

# Install PHP
RUN apt-get install -y php$PHP_VERSION-fpm php$PHP_VERSION-pgsql php$PHP_VERSION-curl php$PHP_VERSION-zip php$PHP_VERSION-xml php$PHP_VERSION-mbstring php$PHP_VERSION-intl php$PHP_VERSION-gd php$PHP_VERSION-soap php$PHP_VERSION-apcu php$PHP_VERSION-redis

# Add nginx repo keys
RUN curl https://nginx.org/keys/nginx_signing.key | gpg --dearmor | tee /usr/share/keyrings/nginx-archive-keyring.gpg >/dev/null

# Add nginx repo
RUN echo "deb [signed-by=/usr/share/keyrings/nginx-archive-keyring.gpg] \
http://nginx.org/packages/mainline/debian `lsb_release -cs` nginx" \
    | tee /etc/apt/sources.list.d/nginx.list
# Install nginx
RUN apt-get update && apt-get install -y nginx

# Install docker client
RUN mkdir -p /etc/apt/keyrings && curl -fsSL https://download.docker.com/linux/debian/gpg | gpg --dearmor -o /etc/apt/keyrings/docker.gpg && echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/debian $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
RUN apt-get update && apt-get install -y docker-ce-cli docker-compose

# Add configs
ADD ./app-nginx.conf /etc/nginx/conf.d/app-nginx.conf
ADD ./app-php.conf /etc/php/$PHP_VERSION/fpm/pool.d/app-php.conf
ADD ./run.sh /opt/run.sh
RUN rm -f /etc/nginx/conf.d/default.conf
RUN rm -f /etc/php/$PHP_VERSION/fpm/pool.d/www.conf
RUN mkdir /run/php
RUN mkdir -p /var/www/app
RUN echo 'opcache.enable=1 \n\
opcache.enable_cli=1 \n\
opcache.jit_buffer_size=256M \n\
max_input_vars = 5000 \n\
upload_max_filesize = 0 \n\
post_max_size = 0'>> /etc/php/$PHP_VERSION/fpm/php.ini
RUN echo 'opcache.enable=1 \n\
opcache.enable_cli=1 \n\
opcache.jit_buffer_size=256M \n\
max_input_vars = 5000 \n\
upload_max_filesize = 0 \n\
post_max_size = 0'>> /etc/php/$PHP_VERSION/cli/php.ini

# Copy CraftBoard
ADD ./craftboard /var/www/app
RUN chown -R nginx /var/www
RUN chmod -R 550 /var/www/app

WORKDIR /var/www/app

STOPSIGNAL SIGTERM

EXPOSE 80
CMD /bin/sh /opt/run.sh
