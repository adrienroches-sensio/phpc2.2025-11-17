<?php

namespace App\Membership;

use App\AuthenticationFailedException;
use App\CanBeAuthenticatedInterface;
use App\ObjectCounter;
use App\User;

class Member implements CanBeAuthenticatedInterface
{
    public function __construct(
        private User $user,
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

    public function isPremium(): bool
    {
        return $this->age >= 30 && $this->age <= 40;
    }

    public function __toString(): string
    {
        return "'{$this->user->getName()}' (age: {$this->age})";
    }
}
