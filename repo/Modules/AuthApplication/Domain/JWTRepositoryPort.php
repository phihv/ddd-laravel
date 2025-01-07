<?php

namespace Modules\AuthApplication\Domain;


interface JWTRepositoryPort
{
    public function generateToken(array $claims) :?string;
    public function decodeToken(string $token) :?JWTClaimSet;
    public function invalidateToken(string $token) :?string;
}
