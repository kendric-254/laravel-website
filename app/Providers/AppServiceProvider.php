<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        }

        Telescope::night();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Telescope::filter(function (IncomingEntry $entry) {
            return $this->app->environment('local') ||
                   $entry->isReportableException() ||
                   $entry->isFailedRequest() ||
                   $entry->isFailedJob() ||
                   $entry->isScheduledTask();
        });
    }
}
