# Use a imagem base do PHP com o Laravel
FROM php:8.1-apache

# Instale as dependências do sistema operacional
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    postgresql-client

# Instale as extensões do PHP necessárias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql

# Configure o Apache para apontar para a pasta 'public' do Laravel
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Ative o módulo 'rewrite' do Apache
RUN a2enmod rewrite

# Copie os arquivos do projeto para o diretório raiz do Apache
COPY . /var/www/html

# Defina as permissões adequadas para o diretório de armazenamento do Laravel
RUN chown -R www-data:www-data /var/www/html/storage

# Instale as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Exponha a porta 80 para acessar a aplicação
EXPOSE 80

# Inicie o Apache no contêiner
CMD ["apache2-foreground"]
