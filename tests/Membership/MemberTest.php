<?php

namespace Test\Membership;

use App\Membership\Member;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use function random_int;

class MemberTest extends TestCase
{
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

    private function createMember(
        string|null $name = null,
        int|null $age = null,
    ): Member {
        $faker = Factory::create();

        return new Member(
            $name ?? $faker->name(),
            $faker->userName(),
            $faker->password(),
            $age ?? random_int(22, 89)
        );
    }
}
