FROM bitnami/laravel:9

WORKDIR /app
COPY . /app

RUN export DEBIAN_FRONTEND=noninteractive && \
    cp .env.production .env && \
    composer install --ignore-platform-reqs && \
    sudo apt-get update && \
    sudo apt-get -y install fluidsynth php-pgsql && \
    sed -i 's/^;extension=pdo_pgsql$/extension=pdo_pgsql/' /opt/bitnami/php/etc/php.ini
