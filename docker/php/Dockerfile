FROM php:7.2-fpm

RUN apt-get update -y \
	&& apt-get install -y libxml2-dev \
	&& docker-php-ext-install pdo pdo_mysql \
	&& rm -rf /tmp/pear \
	&& rm -rf /var/lib/apt/lists/*
	#&& cd /var/www/html/delivery-test \
	#&& php artisan migrate
