<?php

namespace App\Providers;

use App\Repositories\ContactRepositoryImpl;
use App\Repositories\Contracts\ContactRepository;
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
        $this->app->bind(ContactRepository::class, ContactRepositoryImpl::class);
    }
}
