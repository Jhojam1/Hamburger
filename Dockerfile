# Usa una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Habilita soporte para archivos .htaccess (si fuera necesario)
RUN a2enmod rewrite

# Copia todo tu código en la carpeta de Apache
COPY . /var/www/html/

# Da permisos de lectura y escritura al directorio de imágenes (opcional)
RUN chmod -R 755 /var/www/html/uploads

# Exponer el puerto 80 (Render espera este puerto)
EXPOSE 80
