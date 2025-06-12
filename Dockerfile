# Dockerfile
FROM php:8.2-apache

# Apache'de index.php dosyasını varsayılan olarak yüklemek için mod_rewrite etkinleştir
RUN a2enmod rewrite

# Çalışma dizinini ayarla
WORKDIR /var/www/html

# Proje dosyalarını kopyala
COPY . /var/www/html/

# Apache'yi başlat
EXPOSE 80
CMD ["apache2-foreground"]