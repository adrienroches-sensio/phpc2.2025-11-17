<?php

namespace Test\Membership;

use App\Membership\Member;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use function random_int;

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
            username: 'john.smith',
            password: 'some-secret-password',
        );

        // Act
        $member->auth('john.smith', 'some-secret-password');

        // Assert
        $this->expectNotToPerformAssertions();
    }

    private function createMember(
        string|null $name = null,
        string|null $username = null,
        string|null $password = null,
        int|null $age = null,
    ): Member {
        return new Member(
            $name ?? $this->faker->name(),
            $username ?? $this->faker->userName(),
            $password ?? $this->faker->password(),
            $age ?? random_int(22, 89)
        );
    }
}
