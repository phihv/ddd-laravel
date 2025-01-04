<?php

namespace Modules\AuthApplication\Application\Ports\Inbound;

interface UserCommandPort
{
    public function create($params) :void;
}
