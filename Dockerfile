FROM ghcr.io/at-cloud-pro/caddy-php:3.0.0 AS app

ENV VERSION="3.0.0"

RUN apt-get update  \
&& apt-get install --yes --no-install-recommends librabbitmq-dev  \
&& pecl install amqp  \
&& docker-php-ext-enable amqp

COPY ./app /app
RUN composer install

RUN chmod --recursive a+r /app \
&& chmod --recursive a+x /app/bin/* \
&& chown --recursive www-data:www-data /app/var/log \
&& chmod --recursive a+w /app/var/log

ENV APP_ENV="prod"

USER www-data:www-data

HEALTHCHECK CMD curl --fail http://localhost || exit 1
