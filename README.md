<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Docker-compose build base laravel with docker

B1 T???o file dockerfile build c??c image ho???c s??? d???ng c??c images c?? s???n ????? build image
vi du: dockerfile php-fpm

FROM php:7.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory
COPY . .

2B c???u h??nh nginx , t???o th?? m???c nginx ch???a file default.conf ????? c???u h??nh nginx 

server {
    listen 80;
    index index.php index.html;
    server_name localhost; 
    error_log  /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    root /var/www/html/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}

B3 t???o file docker-compose 3 service php-fpm, nginx, sql s??? d???ng image ho???c docker file ????? t???o container 
v?? du: v???i docker s??? d???ng nginx , sql t??? image c?? s???n tr??n dockerhub, v?? php build t??? dockerfile ,

version: '3'

networks:
  laravel:
    driver: bridge
services:
  nginx:
    image: nginx:stable-alpine
    container_name: webserver
    restart: unless-stopped
    tty: true
    ports:
      - "8080:80"
    volumes:
      - ./:/var/www/html
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
    networks:
      - laravel

  mysql:
    image: mysql:5.7.29
    container_name: mysql
    volumes:
      - ./mysql:/var/lib/mysql
    restart: unless-stopped
    tty: true
    ports:
      - "3360:3306"
    environment:
      MYSQL_DATABASE: base
      MYSQL_USER: root
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: secret
      SERVICE_TAGS: dev
      SERVICE_NAME: mysql
    networks:
      - laravel

  php:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: php
    restart: unless-stopped
    tty: true
    volumes:
      - ./:/var/www/html 
    ports:
      - "9000:9000"
    networks:
      - laravel

B4 ch???y docker-compose : s???  d???ng l???nh `docker-compose up -d `, ????? ch???y t???o ra c??c container v?? run ch??ng .
 
 nginx:
     image: nginx:stable-alpine
     container_name: webserver
     restart: unless-stopped
     tty: true
     ports:
       - "8080:80"
     volumes:
       - ./:/var/www/html
       - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
     networks:
       - laravel
 exec v??o trong container t???o database `docker exec -it {IDcontainer} bash `
  ch???y `docker-compose exec php composer install` ????? c??i ?????t 
  t???o file .env project b???ng l???nh `cp .env.example .env`
  ch???y l???nh php `docker-compose exec php artisan key:generate ` t???o key 
  m??? tr??nh duy???t  ch???y  `http://localhost:8080 ` setup v???i port setup 8080 ??? trong service ??? tr??n .
  
  exec v??o trong container t???o database `docker exec -it {IDcontainer} bash `
  truy c???p v??o sql t???o database b???ng terminal 
  `mysql -u root -p secret`
`  CREATE DATABASE database_name;` 
  c???u h??nh file .env
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3360
 DB_DATABASE=database_name
 DB_USERNAME=root
 DB_PASSWORD=secret
 
 `docker-compose down` ????? down c??c container ??ang ch???y.
