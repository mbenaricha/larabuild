<?php

namespace App\Providers;

use App\Services\Determine\Context\ApplicationReader;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->singleton(ApplicationReader::class, function (/*Application $app*/) {
            return new ApplicationReader(config('determine.application_path'));
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
