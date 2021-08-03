<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        /**
         * 5.7.7 より古い MySQLか 10.2.2 より古い MariaDB の場合、これが必要（users テーブルの migration で落ちる）
         * https://laravel.com/docs/master/migrations#index-lengths-mysql-mariadb
         */
        Schema::defaultStringLength(191);
    }
}
