<?php

namespace Test\Membership;

use App\Membership\AdminLevelEnum;
use PHPUnit\Framework\TestCase;

class AdminLevelEnumTest extends TestCase
{
    public function testAllAdminLevelsHaveALabel(): void
    {
        foreach (AdminLevelEnum::cases() as $level) {
            $level->label();

            $this->expectNotToPerformAssertions();
        }
    }
}
