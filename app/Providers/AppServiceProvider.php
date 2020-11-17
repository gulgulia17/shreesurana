<?php

namespace App\Providers;

use App\Models\Data;
use App\Models\File;
use App\Observers\DataObserver;
use App\Observers\FilesObserver;
use Illuminate\Support\ServiceProvider;

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
        File::observe(FilesObserver::class);
        Data::observe(DataObserver::class);
    }
}
