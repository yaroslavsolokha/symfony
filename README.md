Symfony project
=======
Inside - YSUserBundle

#### Setup
##### 1. See https://github.com/yaroslavsolokha/server
##### 2. Up Docker
##### 3. First setup
```
$ cd server
$ docker exec -it php /bin/sh
$ cd symfony
$ composer update
```
##### 4. Create DB, schema
```
$ bin/console doctrine:database:create
$ bin/console doctrine:schema:create
```
##### 5. Install and config YSUserBundle - https://github.com/yaroslavsolokha/YSUserBundle
##### 6. Install assets, clear cache
```
$ bin/console assets:install
$ bin/console cache:clear

```
##### 7. Go symfony:dev:8000/app_dev.php/admin