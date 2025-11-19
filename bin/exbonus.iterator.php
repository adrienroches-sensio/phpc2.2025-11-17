<?php

use App\Membership\Member;
use App\Membership\MemberCollection;
use App\User;
use PHPUnit\Event\Runtime\PHP;

require_once __DIR__ . '/../vendor/autoload.php';

function listAll(iterable $members): void
{
    echo 'La liste des membres :'.PHP_EOL;
    foreach ($members as $member) {
        echo $member.PHP_EOL;
    }
}

function listPremium(MemberCollection $members): void {
    $premiumMembers = $members->getPremiumMembers();

    echo 'La liste des membres premium (total: '.count($premiumMembers).'):'.PHP_EOL;

    foreach ($premiumMembers as $premiumMember) {
        echo $premiumMember.PHP_EOL;
    }
}

function getTotalAgePremium(MemberCollection $members): void
{
    $totalAgePremium = 0;
    foreach ($members->getPremiumMembers() as $member) {
        $totalAgePremium += $member->age;
    }

    echo "Age total des membres premium: {$totalAgePremium}" . PHP_EOL;
}

$members = [
    new Member(new User('John'), 'member1', 'password1', 30),
    new Member(new User('Smith'), 'member2', 'password1', 32),
    new Member(new User('Plop'), 'member3', 'password1', 29),
    new Member(new User('Jane'), 'member4', 'password2', 60),
];

$memberCollection = new MemberCollection($members);

listAll($memberCollection);
echo PHP_EOL;
listPremium($memberCollection);
echo PHP_EOL;
getTotalAgePremium($memberCollection);
