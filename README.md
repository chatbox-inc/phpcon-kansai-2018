# Laravel on Heroku 

[Getting Started on Heroku with PHP \| Heroku Dev Center](https://devcenter.heroku.com/articles/getting-started-with-php#introduction)

[Heroku PHP Support \| Heroku Dev Center](https://devcenter.heroku.com/articles/php-support)


## Application のセットアップ

\1. Heroku 上で新規Appを作成する。

https://dashboard.heroku.com/new-app

\2. Procfile を作成する。

```
web: vendor/bin/heroku-php-apache2 public
```

\3. Heroku に環境変数をセット

```
$ php artisan key:generate --show
```

## Postgres のセットアップ


4. Heroku 上で Postgres を追加

5. AppServiceProvider で 環境変数をパース

```
$this->app->extend("db",function($dbObj){
    $databaseUrl = env("DATABASE_URL");
    if($databaseUrl){
        $config = parse_url($databaseUrl);
        app("config")->set("database.connections.herokupg",[
            'driver' => 'pgsql',
            'host'     => $config["host"],
            'port'     => $config["port"],
            'database' => substr($config["path"],1),
            'username' => $config["user"],
            'password' => $config["pass"]??"",
            'charset'  => env('DB_CHARSET', 'utf8'),
            'prefix'   => env('DB_PREFIX', ''),
            'schema'   => env('DB_SCHEMA', 'public'),
        ]);
    }
    return $dbObj;
});
```

6. 管理画面から `php artisan migrate --force` を実行
