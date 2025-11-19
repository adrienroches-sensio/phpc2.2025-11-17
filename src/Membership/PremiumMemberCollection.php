<?php

namespace App\Membership;

use Closure;
use Countable;
use IteratorAggregate;
use Traversable;

class PremiumMemberCollection implements IteratorAggregate, Countable
{
    public function __construct(
        private MemberCollection $members,
        private Closure $rule,
    ) {
    }

    public function getIterator(): Traversable
    {
        $premiumMembers = [];

        foreach ($this->members as $member) {
            $isPremium = ($this->rule)($member);

            if ($isPremium === true) {
                $premiumMembers[] = $member;
            }
        }

        return new \ArrayIterator($premiumMembers);
    }

    public function count(): int
    {
        return count($this->getIterator());
    }
}
