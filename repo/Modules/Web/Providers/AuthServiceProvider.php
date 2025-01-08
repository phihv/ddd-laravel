<?php

namespace Modules\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\AuthApplication\Application\Ports\Inbound\AuthPort;
use Modules\AuthApplication\Domain\JWTRepositoryPort;
use Modules\AuthApplication\Domain\UserRepositoryPort;
use Modules\AuthApplication\Application\UseCases\AuthAppService;
use Modules\Web\Adapters\Outbound\Auth\JWTRepositoryImpl;
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
        $this->app->bind(AuthPort::class, AuthAppService::class);

        //Outbound
        $this->app->bind(UserRepositoryPort::class, UserRepositoryImpl::class);
        $this->app->bind(JWTRepositoryPort::class, JWTRepositoryImpl::class);
    }
}
