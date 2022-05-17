FROM bitnami/laravel:9

WORKDIR /app
COPY . /app

RUN cp .env.production .env && \
    composer install --ignore-platform-reqs
