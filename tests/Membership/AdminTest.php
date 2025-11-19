<?php

namespace Test\Membership;

use App\AuthenticationFailedException;
use App\Membership\Admin;
use App\Membership\AdminLevelEnum;
use App\Membership\Member;
use App\User;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use function random_int;

#[CoversClass(Admin::class)]
class AdminTest extends TestCase
{
    private Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testCounterIsIncremented(): void
    {
        // Preconditions
        $this->assertSame(0, Admin::getCount());

        // Arrange + Act 1
        $admin1 = $this->createAdmin();
        $admin2 = $this->createAdmin();

        // Assert 1
        $this->assertSame(2, Admin::getCount());

        // Arrange + Act 2
        unset($admin1);

        // Assert 2
        $this->assertSame(1, Admin::getCount());
    }

    public function testAuthIsByPassedIfSuperAdmin(): void
    {
        // Arrange
        $admin = $this->createAdmin(
            login: 'john.smith',
            password: 'some-secret-password',
            level: AdminLevelEnum::SuperAdmin
        );

        // Act
        $admin->auth('wrong-login', 'wrong-password');

        // Assert
        $this->expectNotToPerformAssertions();
    }

    public function testCanBeAuthenticated(): void
    {
        // Arrange
        $admin = $this->createAdmin(
            login: 'john.smith',
            password: 'some-secret-password',
        );

        // Act
        $admin->auth('john.smith', 'some-secret-password');

        // Assert
        $this->expectNotToPerformAssertions();
    }

    public function testCannotBeAuthenticatedIfWrongLogin(): void
    {
        // Arrange
        $admin = $this->createAdmin(
            login: 'john.smith',
            password: 'some-secret-password',
        );

        // Assert
        $this->expectException(AuthenticationFailedException::class);
        $this->expectExceptionCode(AuthenticationFailedException::INVALID_LOGIN_CODE);

        // Act
        $admin->auth('wrong-login', 'some-secret-password');
    }

    public function testCannotBeAuthenticatedIfWrongPassword(): void
    {
        // Arrange
        $admin = $this->createAdmin(
            login: 'john.smith',
            password: 'some-secret-password',
        );

        // Assert
        $this->expectException(AuthenticationFailedException::class);
        $this->expectExceptionCode(AuthenticationFailedException::INVALID_PASSWORD_CODE);

        // Act
        $admin->auth('john.smith', 'wrong-password');
    }

    public function testCanBeCastedToString(): void
    {
        // Arrange
        $admin = $this->createAdmin(
            name: 'John Smith',
            age: 60,
            level: AdminLevelEnum::SuperAdmin
        );

        // Act
        $adminAsString = (string) $admin;

        // Assert
        $this->assertSame("'John Smith' (age: 60) with 'Super Admin 3000 Giga plus' level", $adminAsString);
    }

    private function createAdmin(
        string|null $name = null,
        string|null $login = null,
        string|null $password = null,
        int|null $age = null,
        AdminLevelEnum $level = AdminLevelEnum::Admin
    ): Admin {
        return new Admin(
            new Member(
                new User($name ?? $this->faker->name()),
                $login ?? $this->faker->userName(),
                $password ?? $this->faker->password(),
                $age ?? random_int(22, 89),
            ),
            $level,
        );
    }
}
