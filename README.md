Symfony project
=======
Inside - FOSuserbundle, SonataAdminBundle, SonataUserBundle, HWIOAuthBundle, Material design, Bower.

#### Setup
##### 1. See https://github.com/yaroslavsolokha/server
##### 2. Up Docker
##### 3. First setup
```
$ cd server
$ docker exec -it php /bin/sh
$ cd symfony
$ bin/console doctrine:schema:create
$ bin/console fos:user:create admin --super-admin
$ bower update  --allow-root
$ bin/console assets:install
$ bin/console clear:cache

```
##### 4. Go symfony:dev:8000/app_dev.php/admin

#### TODO
##### 1. Follow - dev-add_support_for_fos_user2