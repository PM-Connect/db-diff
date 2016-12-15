FROM ubuntu:16.10

MAINTAINER Joseph Ralph "http://github.com/jralph"

ENV DEBIAN_FRONTEND noninteractive

COPY ./ /app/

RUN apt-get -y update && apt-get -y upgrade
RUN apt-get install -y php7.0 php7.0-mysql php7.0-sqlite3 php7.0-pgsql php7.0-json php7.0-mbstring php7.0-mcrypt
RUN \
    cd /app/ && \
    rm -rf .env && \
    cp .env.docker .env && \
    php artisan migrate:refresh && \
    php artisan cache:clear && \
    php artisan optimize --force && \
    php artisan route:cache

EXPOSE 80

WORKDIR /app/

CMD php artisan serve --host=0.0.0.0 --port=80
