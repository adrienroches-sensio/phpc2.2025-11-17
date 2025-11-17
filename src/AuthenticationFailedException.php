<?php

class AuthenticationFailedException extends RuntimeException
{
    public const INVALID_LOGIN_CODE = 1;
    public const INVALID_PASSWORD_CODE = 2;

    public static function invalidLogin(string $login, Throwable|null $previous = null): self
    {
        return new self(
            "Invalid login: {$login}",
            code: self::INVALID_LOGIN_CODE,
            previous: $previous,
        );
    }

    public static function invalidPassword(string $login, Throwable|null $previous = null): self
    {
        return new self(
            "Invalid password for {$login}",
            code: self::INVALID_PASSWORD_CODE,
            previous: $previous,
        );
    }
}
