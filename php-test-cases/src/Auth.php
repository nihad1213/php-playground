<?php

declare(strict_types=1);

class Auth
{
    public function login(string $email, string $password): bool
    {
        if ($email === 'test@gmail.com' && $password === '123456') {
            return true;
        }

        return false;
    }
}
