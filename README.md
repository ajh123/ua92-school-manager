# ua92-school-manager
A PHP based website to manage the operations of a school

## Build and run:

1. `docker build -t school .`
2. `docker run --env-file .env -d -p 8080:80 school`

## Configuration

Copy `src/config.sample.php` to `src/config.php` and update the settings to your values:

```php
$DB_HOST = "localhost";
$DB_USERNAME = "username";
$DB_PASSWORD = "password";
$DB_NAME = "db";
```