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

        $faker = Factory::create();

        $member1 = new Member($faker->name(), $faker->userName(), $faker->password(), random_int(22, 89));
        $member2 = new Member($faker->name(), $faker->userName(), $faker->password(), random_int(22, 89));

        $this->assertSame(2, Member::getCount());

        unset($member1);

        $this->assertSame(1, Member::getCount());
    }
}
