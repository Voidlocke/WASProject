 # Setup Instructions

 boleh skip kalau dah ada

  ## Prerequisites
  - PHP 8.2+
  - Composer
  - Node.js & npm
  - MySQL

  ## Installation Steps

  1. Clone the repository with git clone 'theprojecturl'   tanpa ''
  2. Run setup commands:

  ```bash
  # Install dependencies
  composer install
  npm install

  # Setup environment
  cp .env.example .env
  php artisan key:generate

  # Create database
  go to phpmyadmin then CREATE DATABASE moonlit

  # Run migrations
  php artisan migrate

  # Build assets
  npm run build

  # Start server
  php artisan serve


