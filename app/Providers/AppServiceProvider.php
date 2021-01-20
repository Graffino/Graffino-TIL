<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      \URL::forceRootUrl(\Config::get('app.url'));

      if(config('app.env') === 'production') {
        \URL::forceScheme('https');
      }

      if ($this->app->environment('local', 'testing', 'staging')) {
        $this->app->register(DuskServiceProvider::class);
     }
      Schema::defaultStringLength(191);

      Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
