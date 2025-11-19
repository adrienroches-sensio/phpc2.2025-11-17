<?php

use App\Membership\Member;
use App\User;
use PHPUnit\Event\Runtime\PHP;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @param Member[] $members
 */
function listPremium(array $members): void {
    $premiumMembers = [];
    foreach ($members as $member) {
        if ($member->age >= 30 && $member->age <= 40) { // Compte premium
            $premiumMembers[] = $member;
        }
    }

    echo 'La liste des membres premium (total: '.count($premiumMembers).'):'.PHP_EOL;

    foreach ($premiumMembers as $premiumMember) {
        echo $premiumMember.PHP_EOL;
    }
}

function getTotalAgePremium(array $members): void
{
    $totalAgePremium = 0;
    foreach ($members as $member) {
        if ($member->age >= 30 && $member->age <= 40) {
            $totalAgePremium += $member->age;
        }
    }

    echo "Age total des membres premium: {$totalAgePremium}" . PHP_EOL;
}

$members = [
    new Member(new User('John'), 'member1', 'password1', 30),
    new Member(new User('Smith'), 'member2', 'password1', 32),
    new Member(new User('Plop'), 'member3', 'password1', 29),
    new Member(new User('Jane'), 'member4', 'password2', 60),
];

listPremium($members);
echo PHP_EOL;
getTotalAgePremium($members);
