<?php

namespace App\Membership\Premium;

use App\Membership\Member;
use function random_int;

class LuckRule
{
    public function __invoke(Member $member): bool
    {
        return random_int(0, 1) === 1;
    }
}
