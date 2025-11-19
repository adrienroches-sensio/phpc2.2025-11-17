<?php

namespace App\Membership;

use App\CanBeAuthenticatedInterface;
use App\ObjectCounter;

class Admin implements CanBeAuthenticatedInterface
{
    public function __construct(
        private Member $member,
        private AdminLevelEnum $level = AdminLevelEnum::Admin
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
        if ($this->level === AdminLevelEnum::SuperAdmin) {
            return;
        }

        $this->member->auth($login, $password);
    }

    public function __toString(): string
    {
        return "{$this->member} with '{$this->level->label()}' level";
    }
}
