# Welcome to Citi Service!
[![PHP 8.1](https://img.shields.io/badge/php-8.1-%23777BB4?style=for-the-badge&logo=php&logoColor=black">)](https://www.php.net/releases/8_1_0.php)
[![MariaDB 10.3](https://img.shields.io/badge/MariaDB-10.3-003545?style=for-the-badge&logo=mariadb&logoColor=white)](https://mariadb.com/kb/en/mariadb-10332-release-notes/)
[![Nginx 1.17](https://img.shields.io/badge/nginx-1.17-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)](https://nginx.org/en/CHANGES-1.18)
[![Symfony 6.1](https://img.shields.io/badge/symfony-6.1-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)](https://symfony.com/doc/6.1)
[![Yarn](https://img.shields.io/badge/yarn-%232C8EBB.svg?style=for-the-badge&logo=yarn&logoColor=white)](https://www.npmjs.com/package/yarn/v/1.22.5)

#### How to init:
```angular2html
1. make init

2. cd project && docker-compose run --rm php-cli bash 
3. symfony console doctrine:migrations:migrate
4. symfony console doctrine:fixtures:load

или

2. make app-migrations
3. make app-fixtures
```
