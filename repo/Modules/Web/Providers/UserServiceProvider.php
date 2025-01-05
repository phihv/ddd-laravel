<?php

namespace Modules\Web\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\UserApplication\Application\Ports\Inbound\UserCommandPort;
use Modules\UserApplication\Application\UseCases\UserCommandAppService;
use Modules\UserApplication\Domain\UserRepositoryPort;
use Modules\Web\Adapters\Outbound\User\UserRepositoryImpl;


class UserServiceProvider extends ServiceProvider
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
