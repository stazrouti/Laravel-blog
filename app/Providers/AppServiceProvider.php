<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categories;
use Illuminate\Support\Facades\Schema;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot()
    {
        // Retrieve categories data and share it with all views
        if (Schema::hasTable('categories')) {
            $categories = \App\Models\Categories::all();
            View::share('categories', $categories);
        }
    }
    public function register(): void
    {
        //
    }


}
