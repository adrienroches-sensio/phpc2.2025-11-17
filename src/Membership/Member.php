<?php

namespace App\Membership;

use App\AuthenticationFailedException;
use App\CanBeAuthenticatedInterface;
use App\ObjectCounter;
use App\User;
use Stringable;

class Member implements CanBeAuthenticatedInterface, Stringable
{
    public function __construct(
        private readonly User $user,
        public string $login,
        public string $password,
        public int $age
    ) {
        ObjectCounter::add(static::class);
    }

    public function __destruct()
    {
        ObjectCounter::remove(static::class);
    }

    public static function getCount(): int
    {
        return ObjectCounter::getCount(static::class);
    }

    public function auth(string $login, string $password): void
    {
        if ($this->login !== $login) {
            throw AuthenticationFailedException::invalidLogin($login);
        }

        if ($this->password !== $password) {
            throw AuthenticationFailedException::invalidPassword($login);
        }
    }

    public function __toString(): string
    {
        return "'{$this->user->getName()}' (age: {$this->age})";
    }
}
