<?php

namespace Modules\AuthApplication\Application\UseCases;

use Modules\AuthApplication\Application\Ports\Inbound\UserCommandPort;

class UserCommandAppService implements UserCommandPort
{

    function create($params): void
    {
        // TODO: Implement create() method.
        dd($params);
    }
}
