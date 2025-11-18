<?php

use App\Membership\Admin;
use App\Membership\Member;

require_once __DIR__ . '/../vendor/autoload.php';

$member1 = new Member('name_admin', 'admin', 'admin', 32);
$admin1 = new Admin('name_superadmin', 'superadmin', 'superadmin', 56);

var_dump(
    (string) $member1,
    (string) $admin1,
);
