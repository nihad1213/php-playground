<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Auth.php';

class AuthTest extends TestCase
{
    public function testLoginWithValidCredentials(): void
    {
        $auth = new Auth();
        $email = 'test@gmail.com';
        $password = '123456';

        $result = $auth->login($email, $password);

        $this->assertTrue($result);
    }

    public function testLoginWithInvalidPassword(): void
    {
        $auth = new Auth();
    
        $result = $auth->login('test@gmail.com', 'wrongpass');
    
        $this->assertFalse($result);
    }
}