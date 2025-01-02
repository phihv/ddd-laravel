<?php

namespace Modules\AuthApplication\Application\Ports\Inbound;

interface UserCommandPort
{
    function create($params) :void;
}
