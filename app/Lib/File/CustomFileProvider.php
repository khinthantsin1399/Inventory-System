<?php

namespace App\Lib\File;

use App\Lib\File\CustomFile;
use Illuminate\Support\ServiceProvider;

class CustomFileProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('customfilefacade', function () {
            return new CustomFile;
        });

        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('CustomFile', 'App\Lib\File\CustomFileFacade');
        });
    }
}
