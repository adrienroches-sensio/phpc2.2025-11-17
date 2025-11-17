<?php

enum AdminLevelEnum
{
    case Admin;
    case SuperAdmin;

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::SuperAdmin => 'Super Admin 3000 Giga plus',
        };
    }
}
