# ua92-school-manager
A PHP based website to manage the operations of a school

## Build and run:

1. `docker build -t school .`
2. `docker run -d -p 8080:80 school`

## Configuration

Copy `src/config.sample.php` to `src/config.php` and update the settings to correct values in your envrionment:

```php
$DB_HOST = "localhost";
$DB_USERNAME = "username";
$DB_PASSWORD = "password";
$DB_NAME = "db";
$COMPANY_NAME = "School";
```

## Database

An example database has been provided in an export file located at: [./docs/database/school_manager.sql](./docs/database/school_manager.sql).

This database comes with pre-configured example data and 5 user accounts including sample roles:
1. `admin@example.com`: password = `1234`
2. `student@example.com`: password = `1234`
3. `teacher@example.com`: password = `1234`
4. `staff@example.com`: password = `1234`
5. `parentf@example.com`: password = `1234`

**An ER diagram is provided at [./docs/database/er.png](./docs/database/er.png).**