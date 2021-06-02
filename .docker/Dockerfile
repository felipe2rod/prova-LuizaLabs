FROM wyveo/nginx-php-fpm:latest
COPY .docker/nginx-config.conf /etc/nginx/conf.d/default.conf
COPY .docker/dockerrun.sh /usr/local/bin/dockerrun.sh
COPY .docker/wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/dockerrun.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh
