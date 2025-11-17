<?php

require_once __DIR__ . '/../src/Member.php';
require_once __DIR__ . '/../src/AdminLevelEnum.php';
require_once __DIR__ . '/../src/Admin.php';

echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 0
echo 'Admin  count : ' . Admin::getCount() . PHP_EOL; // Should be 0
echo PHP_EOL;

$member1 = new Member('admin', 'admin', 32);
$member2 = new Member('user', 'user', 25);

echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 2
echo 'Admin  count : ' . Admin::getCount() . PHP_EOL; // Should be 0
echo PHP_EOL;

unset($member1);
$admin1 = new Admin('superadmin', 'superadmin', 56);

echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 1
echo 'Admin  count : ' . Admin::getCount() . PHP_EOL; // Should be 1
echo PHP_EOL;
