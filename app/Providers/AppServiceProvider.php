<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend("db",function($dbObj)
        {
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
    }
}
