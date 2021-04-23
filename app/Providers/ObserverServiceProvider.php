<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\PageData;
use App\Observers\PageDataObserver;
use App\Observers\PageObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Page::observe(PageObserver::class);
        PageData::observe(PageDataObserver::class);
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
