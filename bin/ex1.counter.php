<?php

require_once __DIR__ . '/../src/Member.php';
require_once __DIR__ . '/../src/AdminLevelEnum.php';
require_once __DIR__ . '/../src/Admin.php';

echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 0
$member1 = new Member('admin', 'admin', 32);
$member2 = new Member('user', 'user', 25);
echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 2
unset($member1);
echo 'Member count : ' . Member::getCount() . PHP_EOL; // Should be 1
