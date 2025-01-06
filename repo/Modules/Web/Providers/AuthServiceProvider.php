<?php

namespace Modules\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\AuthApplication\Application\Ports\Inbound\AuthCommandPort;
use Modules\AuthApplication\Domain\JwtRepositoryPort;
use Modules\AuthApplication\Domain\UserRepositoryPort;
use Modules\AuthApplication\Application\UseCases\AuthCommandAppService;
use Modules\Web\Adapters\Outbound\Auth\JwtRepositoryImpl;
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
        $this->app->bind(AuthCommandPort::class, AuthCommandAppService::class);

        //Outbound
        $this->app->bind(UserRepositoryPort::class, UserRepositoryImpl::class);
        $this->app->bind(JwtRepositoryPort::class, JwtRepositoryImpl::class);
    }
}
