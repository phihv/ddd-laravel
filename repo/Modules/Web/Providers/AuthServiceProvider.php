<?php

namespace Modules\Web\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\AuthApplication\Application\Ports\Inbound\UserCommandPort;
use Modules\AuthApplication\Application\UseCases\UserCommandAppService;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(UserCommandPort::class, UserCommandAppService::class);
    }
}
