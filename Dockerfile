FROM php:8.2-apache

# ติดตั้ง mysqli extension สำหรับเชื่อมต่อ MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# เปิดใช้งาน mod_rewrite ของ Apache (สำหรับการทำ Clean URL ในอนาคต)
RUN a2enmod rewrite