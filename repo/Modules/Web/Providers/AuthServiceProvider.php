<?php

namespace Modules\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\AuthApplication\Application\Ports\Inbound\AuthenticatorPort;
use Modules\AuthApplication\Application\Ports\Inbound\AuthorizationPort;
use Modules\AuthApplication\Application\UseCases\AuthenticatorAppService;
use Modules\AuthApplication\Domain\PermissionRepositoryPort;
use Modules\AuthApplication\Domain\RoleRepositoryPort;
use Modules\AuthApplication\Domain\TokenRepositoryPort;
use Modules\AuthApplication\Domain\UserRepositoryPort;
use Modules\AuthApplication\Application\UseCases\AuthorizationAppService;
use Modules\Web\Adapters\Outbound\Auth\PermissionRepositoryImpl;
use Modules\Web\Adapters\Outbound\Auth\RoleRepositoryImpl;
use Modules\Web\Adapters\Outbound\Auth\TokenRepositoryImpl;
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
        $this->app->bind(AuthorizationPort::class, AuthorizationAppService::class);
        $this->app->bind(AuthenticatorPort::class, AuthenticatorAppService::class);

        //Outbound
        $this->app->bind(UserRepositoryPort::class, UserRepositoryImpl::class);
        $this->app->bind(RoleRepositoryPort::class, RoleRepositoryImpl::class);
        $this->app->bind(PermissionRepositoryPort::class, PermissionRepositoryImpl::class);
        $this->app->bind(TokenRepositoryPort::class, TokenRepositoryImpl::class);
    }
}
