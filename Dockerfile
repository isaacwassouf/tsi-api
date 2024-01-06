# Use the official Nginx Unit Docker image
FROM nginx/unit:1.29.1-php8.1

# Set the working directory
WORKDIR /var/www/html

# Copy the Laravel application code
COPY . /var/www/html/

# Set up Nginx Unit configuration
COPY unit_config.json /docker-entrypoint.d/

# Change ownership and permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/storage

# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install MYSQL PDO extension
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# install git and zip
RUN apt-get update && apt-get install -y git zip

# Install dependencies
RUN composer install --no-dev --no-interaction --no-progress --no-suggest --optimize-autoloader

# Expose port 8080 for Nginx Unit
EXPOSE 8080

