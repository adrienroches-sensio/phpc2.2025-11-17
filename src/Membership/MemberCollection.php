<?php

namespace App\Membership;

use App\Membership\Premium\AgeRule;
use App\Membership\Premium\LuckRule;
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
        private readonly iterable $members,
    ) {
    }

    public function getPremiumMembers(): PremiumMemberCollection
    {
        return new PremiumMemberCollection(
            $this,
            function (Member $member) {
                $result = true;
                $rules = [
                    new AgeRule(),
                    new LuckRule(),
                ];

                foreach ($rules as $rule) {
                    $result = $result && $rule($member);
                }

                return $result;
            }
        );
    }

    public function getIterator(): Traversable
    {
        return is_array($this->members) ? new ArrayIterator($this->members) : $this->members;
    }
}
