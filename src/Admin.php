<?php

class Admin extends Member
{
    public function __construct(
        string $login,
        string $password,
        int $age,
        private AdminLevelEnum $level = AdminLevelEnum::Admin
    ) {
        parent::__construct($login, $password, $age);
    }

    public function auth(string $login, string $password): bool
    {
        if ($this->level === AdminLevelEnum::SuperAdmin) {
            return true;
        }

        return parent::auth($login, $password);
    }
}
