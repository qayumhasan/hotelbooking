<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Logo;
use App\Models\Seo;
use App\Models\Addon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $logos=Logo::first();
        view()->share('logos', $logos);
        $seo=Seo::first();
        view()->share('seo', $seo);
        $permit = new Addon();
        view()->share('permit', $permit);
    }
}
