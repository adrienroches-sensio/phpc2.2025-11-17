<?php

namespace App\Membership;

use App\AuthenticationFailedException;
use App\CanBeAuthenticatedInterface;
use App\User;
use Deprecated;

class Member implements CanBeAuthenticatedInterface
{
    private static array $counter = [];

    public function __construct(
        private User $user,
        public string $login,
        public string $password,
        public int $age
    ) {
        self::$counter[static::class] ??= 0;
        self::$counter[static::class]++;
    }

    public function __destruct()
    {
        self::$counter[static::class]--;
    }

    public static function getCount(): int
    {
        return self::$counter[static::class] ?? 0;
    }

    #[Deprecated]
    public function getName(): string
    {
        return $this->user->getName();
    }

    #[Deprecated]
    public function setName(string $name): void
    {
        $this->user->setName($name);
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
        return "'{$this->getName()}' (age: {$this->age})";
    }
}
