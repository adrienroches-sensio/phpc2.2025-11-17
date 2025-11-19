<?php

use App\Membership\Admin;
use App\Membership\Member;
use App\User;

require_once __DIR__ . '/../vendor/autoload.php';

echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 0
echo 'Admin  count : ' . Admin::getCount() . PHP_EOL; // Should be 0
echo PHP_EOL;

$member1 = new Member(new User('name_admin'), 'admin', 'admin', 32);
$member2 = new Member(new User('name_user'), 'user', 'user', 25);

echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 2
echo 'Admin  count : ' . Admin::getCount() . PHP_EOL; // Should be 0
echo PHP_EOL;

unset($member1);
$admin1 = new Admin(new Member(new User('name_superadmin'), 'superadmin', 'superadmin', 56));

echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 1
echo 'Admin  count : ' . Admin::getCount() . PHP_EOL; // Should be 1
echo PHP_EOL;
