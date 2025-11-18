<?php

final class MySingleton // Final prevents inheritance
{
    private static self $instance; // Static so the instance can be shared across all instances

    private function __construct() {} // Private to prevent instantiation from outside the class
    private function __clone() {} // Private to prevent cloning the instance

    public static function get(): self // Static method to get the singleton instance
    {
        return self::$instance ??= new self(); // ??= assigns the instance if it's not already set
    }
}

var_dump(
    MySingleton::get() === MySingleton::get(), // Always the same instance
);
