FROM php:8.3-apache

# Instalar librerías necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensión PostgreSQL
RUN docker-php-ext-install pdo_pgsql

# Habilitar mod_rewrite en Apache
RUN a2enmod rewrite

# Cambiar documento raíz
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Permisos para Apache
RUN chown -R www-data:www-data /var/www/html

# Puerto que expone
EXPOSE 8080