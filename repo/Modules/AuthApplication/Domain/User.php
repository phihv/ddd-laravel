<?php

namespace Modules\AuthApplication\Domain;

use DateTime;

class User
{
    public function __construct(
        string $username,
        Email $email,
        string $password,
//        DateTime $createdAt
    )
    {
    }

}
