<?php

namespace Test\Membership;

use App\AuthenticationFailedException;
use App\Membership\Member;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use function random_int;

#[CoversClass(Member::class)]
class MemberTest extends TestCase
{
    private Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testCounterIsIncremented(): void
    {
        // Preconditions
        $this->assertSame(0, Member::getCount());

        // Arrange + Act 1
        $member1 = $this->createMember();
        $member2 = $this->createMember();

        // Assert 1
        $this->assertSame(2, Member::getCount());

        // Arrange + Act 2
        unset($member1);

        // Assert 2
        $this->assertSame(1, Member::getCount());
    }

    public function testCanBeCastedToString(): void
    {
        // Arrange
        $member = $this->createMember(
            name: 'John Smith',
            age: 60,
        );

        // Act
        $memberAsString = (string) $member;

        // Assert
        $this->assertSame("'John Smith' (age: 60)", $memberAsString);
    }

    public function testCanBeAuthenticated(): void
    {
        // Arrange
        $member = $this->createMember(
            login: 'john.smith',
            password: 'some-secret-password',
        );

        // Act
        $member->auth('john.smith', 'some-secret-password');

        // Assert
        $this->expectNotToPerformAssertions();
    }

    public function testCannotBeAuthenticatedIfWrongLogin(): void
    {
        // Arrange
        $member = $this->createMember(
            login: 'john.smith',
            password: 'some-secret-password',
        );

        // Assert
        $this->expectException(AuthenticationFailedException::class);
        $this->expectExceptionCode(AuthenticationFailedException::INVALID_LOGIN_CODE);

        // Act
        $member->auth('wrong-login', 'some-secret-password');
    }

    public function testCannotBeAuthenticatedIfWrongPassword(): void
    {
        // Arrange
        $member = $this->createMember(
            login: 'john.smith',
            password: 'some-secret-password',
        );

        // Assert
        $this->expectException(AuthenticationFailedException::class);
        $this->expectExceptionCode(AuthenticationFailedException::INVALID_PASSWORD_CODE);

        // Act
        $member->auth('john.smith', 'wrong-password');
    }

    private function createMember(
        string|null $name = null,
        string|null $login = null,
        string|null $password = null,
        int|null $age = null,
    ): Member {
        return new Member(
            $name ?? $this->faker->name(),
            $login ?? $this->faker->userName(),
            $password ?? $this->faker->password(),
            $age ?? random_int(22, 89),
        );
    }
}
