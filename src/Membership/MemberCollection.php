<?php

namespace App\Membership;

use ArrayIterator;
use IteratorAggregate;
use Traversable;
use function is_array;

class MemberCollection implements IteratorAggregate
{
    /**
     * @param Member[] $members
     */
    public function __construct(
        private iterable $members,
    ) {
    }

    public function getPremiumMembers(): array
    {
        $premiumMembers = [];

        foreach ($this->members as $member) {
            if ($member->isPremium()) {
                $premiumMembers[] = $member;
            }
        }

        return $premiumMembers;
    }

    public function getIterator(): Traversable
    {
        return is_array($this->members) ? new ArrayIterator($this->members) : $this->members;
    }
}
