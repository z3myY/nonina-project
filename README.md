# Instalar proyecto

## Requisitos
- php 7.4+
- apache
- mariadb

[Instalar con XAMPP](https://www.apachefriends.org/es/index.html)

## Instalación
```console
git clone https://github.com/z3myY/nonina-project.git
cd nonina-project
```
- Copiar .env en .env.local
- Crear la variable DATABASE_URL en el env.local para que quede así:

> DATABASE_URL="mysql://root:@127.0.0.1:3306/noninadb?serverVersion=mariadb-10.4.18"

```console
composer install
php bin/console d:d:c
php bin/console d:m:m
```
## Cargar datos de prueba

```console
php bin/console doctrine:fixtures:load
```

## Reseteo bbdd Heroku
```console
php bin/console d:schema:drop --full-database --force
php bin/console d:s:u --force 
chmod 777 heroku_fixtures.sh
./heroku_fixtures.sh
```
