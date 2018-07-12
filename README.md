# Laravel on Heroku 

[Getting Started on Heroku with PHP \| Heroku Dev Center](https://devcenter.heroku.com/articles/getting-started-with-php#introduction)

[Heroku PHP Support \| Heroku Dev Center](https://devcenter.heroku.com/articles/php-support)


1. Heroku 上で新規Appを作成する。

https://dashboard.heroku.com/new-app

2. Procfile を作成する。

```
web: vendor/bin/heroku-php-apache2 public
```

3. Heroku に環境変数をセット

```
$ php artisan key:generate --show
```
