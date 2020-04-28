<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\CategoryController;

class DatabaseProvider extends ServiceProvider
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
        /*
        $this->app->when([CategoryController::class])
        ->needs(CategoryRepository::class)
        ->give(function () {
            return new DBCategoryRepository();
        });
        */

  }
}
