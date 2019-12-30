FROM php:5.6-apache
RUN apt-get update && \
  apt-get install -y ssmtp build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev && \
  apt-get clean && \
  echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf && \
  echo 'sendmail_path = "/usr/sbin/ssmtp -t"' > /usr/local/etc/php/conf.d/mail.ini
RUN a2enmod rewrite
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd
RUN docker-php-ext-install pdo pdo_mysql
RUN service apache2 restart