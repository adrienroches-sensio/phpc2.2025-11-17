<?php

namespace Test\Membership;

use App\Membership\Member;
use PHPUnit\Framework\TestCase;

class MemberTest extends TestCase
{
    public function testCounterIsIncremented(): void
    {
        $this->assertSame(0, Member::getCount());

        $member1 = new Member('John', 'john', '123456', 12);
        $member2 = new Member('Smith', 'smith', 'kjkljsklajd', 65);

        $this->assertSame(2, Member::getCount());

        unset($member1);

        $this->assertSame(1, Member::getCount());
    }
}
