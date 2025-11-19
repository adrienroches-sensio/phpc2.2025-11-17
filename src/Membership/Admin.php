<?php

namespace App\Membership;

use App\User;

class Admin extends Member
{
    public function __construct(
        User $user,
        string $login,
        string $password,
        int $age,
        private AdminLevelEnum $level = AdminLevelEnum::Admin
    ) {
        parent::__construct($user, $login, $password, $age);
    }

    public function auth(string $login, string $password): void
    {
        if ($this->level === AdminLevelEnum::SuperAdmin) {
            return;
        }

        parent::auth($login, $password);
    }

    public function __toString(): string
    {
        $parent = parent::__toString();

        return "{$parent} with '{$this->level->label()}' level";
    }
}
