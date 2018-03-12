FROM alpine:latest
LABEL Maintainer="Ben Piper <ben@benpiper.com>" \
      Description="r53-ec2-web"

ENV RES_OPTIONS="retrans:1 retry:1 timeout:1 attempts:1" \
    # DBHOSTNAME="db.benpiper.host" \
    HEAP_APP_ID="4262411627"

# Install packages
RUN apk --no-cache add php7 php7-fpm php7-json \
    php7-zlib php7-xml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype \
    php7-mbstring nginx supervisor

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php7/php-fpm.d/zzz_custom.conf
COPY config/php.ini /etc/php7/conf.d/zzz_custom.ini

# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Add application
RUN mkdir -p /var/www/html
WORKDIR /var/www/html
COPY src/ /var/www/html/
RUN chmod o+w /var/www/html/countlog.txt

EXPOSE 80 443
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
