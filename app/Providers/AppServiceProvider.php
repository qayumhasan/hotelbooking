<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Logo;
use App\Models\Seo;
use App\Models\Addon;
use App\Models\ImageManager;
use App\Models\CompanyInformation;

use App\Models\Currency;
use App\Traits\CalculatePerDayRoomTarrif;

use App\Traits\NumberToWord;

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
        $paginate = ImageManager::all();
        view()->share('paginate', $paginate);
        $companyinformation = CompanyInformation::first();
        view()->share('companyinformation', $companyinformation);
        $numberToWord = new NumberToWord();
        view()->share('numToWord', $numberToWord);
        $roomTarrif = new CalculatePerDayRoomTarrif();
        view()->share('roomTarrif', $roomTarrif);


        // $currency = cache()->remember('currency',60*60*24,function(){
        //     return Currency::where('is_default',1)->first(); 
        // });
        // view()->share('currency', $currency);
    }
}
