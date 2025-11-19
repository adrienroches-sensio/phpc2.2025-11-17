<?php

namespace App\Membership;

use IteratorAggregate;
use Traversable;

class MemberCollection implements IteratorAggregate
{
    /**
     * @param Member[] $members
     */
    public function __construct(
        private array $members,
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
        return new \ArrayIterator($this->members);
    }
}
