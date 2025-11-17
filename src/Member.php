<?php

class Member
{
    private static int $count = 0;

    public function __construct(
        public string $login,
        public string $password,
        public int $age
    ) {
        self::$count++;
    }

    public function __destruct()
    {
        self::$count--;
    }

    public static function getCount(): int
    {
        return self::$count;
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
