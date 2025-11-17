<?php

class Admin extends Member
{
    public function __construct(
        string $name,
        string $login,
        string $password,
        int $age,
        private AdminLevelEnum $level = AdminLevelEnum::Admin
    ) {
        parent::__construct($name, $login, $password, $age);
    }

    public function auth(string $login, string $password): bool
    {
        if ($this->level === AdminLevelEnum::SuperAdmin) {
            return true;
        }

        return parent::auth($login, $password);
    }

    public function __toString(): string
    {
        $parent = parent::__toString();

        return "{$parent} with '{$this->level->label()}' level";
    }
}
