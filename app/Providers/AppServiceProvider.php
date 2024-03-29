<?php

namespace App\Providers;

use App\Services\Shopify;
use Illuminate\Support\ServiceProvider;
use Storyblok\Client as Storyblok;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Storyblok::class, function ($app) {
            $client = new Storyblok(config('services.storyblok'));
            $client
                //->editMode($app->environment(['local']))
                ->setCache('filesytem', ['path' => storage_path('story-cache')]);

            return $client;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Shopify::boot();
    }
}
