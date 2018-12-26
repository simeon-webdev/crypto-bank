## Requirements

- PHP 7
- MySQL
- Redis
- Composer
- NodeJS
- Apache or other web server
## Installation

- Install dependencies with: 
```
    composer install
```
- Install node js dependencies with:
```
    npm install
```
- Generate APP_KEY
```
    php artisan key:generate
```
- Change database parameters into the .env to your own
```
DB_HOST
DB_DATABASE
DB_USERNAME
DB_PASSWORD
```
- Broadcast driver into the .env should be redis
```
BROADCAST_DRIVER=redis
```
- Start the database migrations and seeders with:
```
    php artisan migrate --seed
```
- Start the web socket with:
```
    node socket.js
```
- PHPUnit tests are started with:
```
    vendor/bin/phpunit
```