<?php

namespace Test\Membership;

use App\Membership\AdminLevelEnum;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(AdminLevelEnum::class)]
class AdminLevelEnumTest extends TestCase
{
    public function testAllAdminLevelsHaveALabel(): void
    {
        foreach (AdminLevelEnum::cases() as $level) {
            $level->label();

            $this->expectNotToPerformAssertions();
        }
    }

    public static function expectedLabelProvider(): Generator
    {
        yield 'Admin' => [AdminLevelEnum::Admin, 'Admin'];
        yield 'Super Admin' => [AdminLevelEnum::SuperAdmin, 'Super Admin 3000 Giga plus'];
    }

    #[DataProvider('expectedLabelProvider')]
    public function testLabelIsCorrect(AdminLevelEnum $level, string $expectedLabel): void
    {
        $this->assertSame($expectedLabel, $level->label());
    }
}
