<?php

declare(strict_types=1);

namespace Test;

use App\AuthenticationFailedException;
use PHPUnit\Framework\TestCase;

class AuthenticationFailedExceptionTest extends TestCase
{
    public function testCorrectCodeAndMessageIfWrongLogin(): void
    {
        // Arrange
        $login = 'john.smith';

        // Act
        $exception = AuthenticationFailedException::invalidLogin($login);

        // Assert
        $this->assertSame(AuthenticationFailedException::INVALID_LOGIN_CODE, $exception->getCode());
        $this->assertSame('Invalid login: john.smith', $exception->getMessage());
    }

    public function testCorrectCodeAndMessageIfWrongPassword(): void
    {
        // Arrange
        $login = 'john.smith';

        // Act
        $exception = AuthenticationFailedException::invalidPassword($login);

        // Assert
        $this->assertSame(AuthenticationFailedException::INVALID_PASSWORD_CODE, $exception->getCode());
        $this->assertSame('Invalid password for john.smith', $exception->getMessage());
    }
}
