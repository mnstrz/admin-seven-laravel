<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminSevenProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path().'/Admin/AdminSevenHelper.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
