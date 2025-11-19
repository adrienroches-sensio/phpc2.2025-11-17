<?php

namespace App\Membership;

class MemberCollection
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
}
