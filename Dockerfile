FROM ericgaonz/laravel:1.0 as environment
# ---
FROM environment as build
ARG BUILD_ENV=production
ARG OPTIMIZE=true
COPY src/ ${WORKDIR}
RUN composer run-script install:prod
RUN if [[ $OPTIMIZE == 'true' ]]; then php artisan build:optimize; else echo "Laravel optimize off"; fi
RUN if [[ $BUILD_ENV == 'development' ]]; then \
    sed -i -r "s/opcache.validate_timestamps=0/opcache.validate_timestamps=1/g" /usr/local/etc/php/conf.d/opcache.ini-enabled; \
    echo "opcache.revalidate_freq=1" >> /usr/local/etc/php/conf.d/opcache.ini-enabled; \
    else echo "Not development, leaving opcache revalidation alone"; fi
RUN echo "opcache.jit_buffer_size=100M" >> /usr/local/etc/php/conf.d/opcache.ini-enabled \
    && echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/opcache.ini-enabled \
    && cp /usr/local/etc/php/php.ini-${BUILD_ENV} /usr/local/etc/php/php.ini \
    && sed -i -r "s/post_max_size = 8M/post_max_size = 20M/g" /usr/local/etc/php/php.ini \
    && sed -i -r "s#access.log = /proc/self/fd/2#; access.log = /proc/self/fd/2#g" /usr/local/etc/php-fpm.d/docker.conf