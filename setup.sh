#!/bin/bash

# Exit immediately if a command exits with a non-zero status.
set -e

echo "--- STARTING SETUP SCRIPT (SQLite version, with --force) ---"

# Step 1: Install PHP and required extensions
echo "--- Installing PHP and extensions ---"
sudo apt-get update
sudo apt-get install -y php-cli php-mbstring php-xml php-curl php-zip unzip php-sqlite3

# Step 2: Install Composer
echo "--- Installing Composer ---"
if ! command -v composer &> /dev/null
then
    echo "Composer not found, installing..."
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    sudo mv composer.phar /usr/local/bin/composer
else
    echo "Composer is already installed."
fi

# Step 3: Create .env file
echo "--- Creating .env file ---"
if [ ! -f .env ]; then
    echo ".env not found. Copying from .env.example"
    cp .env.example .env
    sed -i 's/APP_ENV=local/APP_ENV=development/' .env
fi

# Step 4: Install Composer dependencies
echo "--- Installing Composer dependencies ---"
composer install --no-interaction --no-progress

# Step 5: Generate Laravel application key
echo "--- Generating application key ---"
php artisan key:generate

# Step 6: Create SQLite database file and run migrations
echo "--- Preparing SQLite database and running migrations ---"
touch database/database.sqlite
php artisan migrate --force

echo "--- SETUP SCRIPT FINISHED SUCCESSFULLY ---"
