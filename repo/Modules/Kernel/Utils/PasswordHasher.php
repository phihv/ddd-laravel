<?php

namespace Modules\Kernel\Utils;

class PasswordHasher
{
    public static function hash(string $plainPassword): string
    {
        return bcrypt($plainPassword);
    }


    public static function verify(string $plainPassword, string $hashedPassword): bool
    {
        return \Hash::check($plainPassword, $hashedPassword);
    }

}
