FROM php:8.0-fpm

# Установка зависимостей и утилит
RUN apt-get update && apt-get install -y \
    git \
    zlib1g-dev \
    librdkafka-dev

# Установка php-rdkafka
RUN pecl install rdkafka && \
    docker-php-ext-enable rdkafka

# Копирование PHP-конфигурационного файла
COPY php.ini /usr/local/etc/php/

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html