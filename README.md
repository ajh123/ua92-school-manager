# ua92-school-manager
A PHP based website to manage the operations of a school

## Build and run:

1. `docker build -t school .`
2. `docker run --env-file .env -d -p 8080:80 school`

## Envrionment variables:

Create a .env file with these values 

- `DB_HOST=<your server IP>`
- `DB_USERNAME=<your db user name>`
- `DB_PASSWORD=<your account name>`
- `DB_NAME=<the database name>`