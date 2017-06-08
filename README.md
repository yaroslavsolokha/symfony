Symfony project
=======
Inside - YSUserBundle, YSBlogBundle

#### Setup
##### 1. See https://github.com/yaroslavsolokha/server
##### 2. Up Docker
```
$ cd server
$ docker-compose up
```
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
##### 7. Install and config YSBlogBundle - https://github.com/yaroslavsolokha/YSBlogBundle
##### 8. Go symfony:dev:8000/app_dev.php/admin