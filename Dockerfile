# Spécifier l'image de base, utilisez la version de PHP que vous préférez
FROM php:8.1-fpm

# Copiez composer.lock et composer.json
COPY composer.lock composer.json /var/www/

# Configurer le répertoire de travail
WORKDIR /var/www

# Installez les dépendances
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev zip unzip \
    libonig-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Effacer le cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installez les extensions PHP
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath opcache gd

# Installer composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier le code de l'application existant à partir de votre dossier d'application
COPY . /var/www

# Exposez le port 9000 et démarrez le serveur PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
