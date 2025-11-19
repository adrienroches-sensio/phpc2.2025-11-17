<?php

namespace App;

class ObjectCounter
{
    private static array $counter = [];

    public static function add(string $class): void
    {
        self::$counter[$class] ??= 0;
        self::$counter[$class]++;
    }

    public static function remove(string $class): void
    {
        self::$counter[$class]--;
    }

    public static function getCount(string $class): int
    {
        return self::$counter[$class] ?? 0;
    }
}
