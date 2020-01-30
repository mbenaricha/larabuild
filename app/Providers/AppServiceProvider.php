<?php

namespace App\Providers;

use App\Services\Determine\Context\ApplicationReader;
use Illuminate\Cache\Repository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\SimpleCache\CacheInterface;
use webignition\JsonPrettyPrinter\JsonPrettyPrinter;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->singleton(ApplicationReader::class, function (Application $app) {
            return new ApplicationReader(config('determine.application_path'), $app->make(CacheInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot ()
    {
        //
    }

    public function provides ()
    {
        return [ApplicationReader::class];
    }
}
