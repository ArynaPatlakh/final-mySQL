FROM php:8.0-cli

# Установка утилит: git, unzip, zip
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем файлы проекта
COPY . /var/www/html
WORKDIR /var/www/html

# Устанавливаем зависимости
RUN composer install

CMD ["php", "index.php"]
