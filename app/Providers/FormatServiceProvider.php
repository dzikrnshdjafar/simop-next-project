<?php

namespace App\Providers;

use App\Utils\FormatUtils;
use Illuminate\Support\ServiceProvider;

class FormatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('format', function () {
            return new FormatUtils();
        });
    }

    public function boot(): void
    {
        //
    }
}
