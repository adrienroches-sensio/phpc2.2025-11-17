<?php

class Member
{
    private static array $counter = [];

    public function __construct(
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

    public function auth(string $login, string $password): bool
    {
        if ($this->login !== $login) {
            return false;
        }

        if ($this->password !== $password) {
            return false;
        }

        return true;
    }
}
