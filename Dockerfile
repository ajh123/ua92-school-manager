FROM ubuntu 

# Install Apache, PHP, and required modules
RUN apt update && \
    apt install -y apache2 apache2-utils php libapache2-mod-php && \
    apt clean 

# Enable the correct PHP module (detects installed PHP version)
RUN a2enmod php$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")

# Copy the entire `src/` directory to `/var/www/html/`
COPY src/ /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Update Apache configuration to serve only `public/`
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]
