<?php

namespace App\Providers;

use App\Interfaces\IPageDataRepository;
use App\Interfaces\IPageRepository;
use App\Repositories\PageDataRepository;
use App\Repositories\PageRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IPageRepository::class, PageRepository::class);
        $this->app->bind(IPageDataRepository::class, PageDataRepository::class);
    }
}
