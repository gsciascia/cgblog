<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        // Using Closure based composers...


        view()->composer('blog.sidebar-categories','App\Http\ViewComposers\SidebarCategoryComposer');
     }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
