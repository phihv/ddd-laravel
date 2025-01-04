<?php

namespace Modules\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\AuthApplication\Application\Ports\Inbound\UserCommandPort;
use Modules\AuthApplication\Application\UseCases\UserCommandAppService;
use Modules\AuthApplication\Domain\UserRepositoryPort;
use Modules\Web\Adapters\Outbound\Auth\UserRepositoryImpl;


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
        //Inbound
        $this->app->bind(UserCommandPort::class, UserCommandAppService::class);

        //Outbound
        $this->app->bind(UserRepositoryPort::class, UserRepositoryImpl::class);
    }
}
