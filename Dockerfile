FROM php:8.0-apache

# Установка git, unzip и других утилит
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка расширения mysqli
RUN docker-php-ext-install mysqli

# Копируем проект
COPY . /var/www/html
WORKDIR /var/www/html

# Устанавливаем зависимости Composer
RUN composer install

# (Опционально) Включаем mod_rewrite, если используешь .htaccess
RUN a2enmod rewrite
