<?php

namespace App\Membership\Premium;

use App\Membership\Member;

class AgeRule
{
    public function __invoke(Member $member): bool
    {
        return $member->age >= 30 && $member->age <= 40;
    }
}
