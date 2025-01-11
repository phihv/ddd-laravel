<?php

namespace Modules\AuthApplication\Domain;


interface TokenRepositoryPort
{
    public function generateAccessToken(array $claims) :?string;
    public function decodeAccessToken(string $token) :?AccessToken;
    public function storeRefreshToken(array $tokenData) :void;
}
