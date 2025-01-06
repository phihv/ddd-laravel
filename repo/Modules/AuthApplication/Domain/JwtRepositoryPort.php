<?php

namespace Modules\AuthApplication\Domain;


interface JwtRepositoryPort
{
    public function generateToken(array $claims) :?string;
    public function decodeToken(string $token) :?string;
    public function invalidateToken(string $token) :?string;
}
