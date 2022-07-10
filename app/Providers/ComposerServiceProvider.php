<?php

namespace App\Providers;

use App\Http\ViewComposers\InfoComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       // View::composer('admin.layouts.navbar',InfoComposer::class);
       view()->composer(
        '*',
        'App\Http\ViewComposers\InfoComposer'
    );
    }
}
