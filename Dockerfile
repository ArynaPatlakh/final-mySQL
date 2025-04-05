FROM php:8.0-cli

# Install necessary tools
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . /var/www/html
WORKDIR /var/www/html

# Install dependencies
RUN composer install || true

# Serve static and PHP files on port 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
