<?php

class Member extends User implements CanBeAuthenticatedInterface
{
    private static array $counter = [];

    public function __construct(
        string $name,
        public string $login,
        public string $password,
        public int $age
    ) {
        self::$counter[static::class] ??= 0;
        self::$counter[static::class]++;
        parent::__construct($name);
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

    public function __toString(): string
    {
        return "'{$this->getName()}' (age: {$this->age})";
    }
}
