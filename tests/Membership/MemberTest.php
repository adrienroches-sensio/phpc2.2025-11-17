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
        $this->assertSame(0, Member::getCount());

        $member1 = $this->createMember();
        $member2 = $this->createMember();

        $this->assertSame(2, Member::getCount());

        unset($member1);

        $this->assertSame(1, Member::getCount());
    }

    private function createMember(): Member
    {
        $faker = Factory::create();

        return new Member($faker->name(), $faker->userName(), $faker->password(), random_int(22, 89));
    }
}
