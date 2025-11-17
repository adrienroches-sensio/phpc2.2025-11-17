<?php

require_once __DIR__ . '/../src/User.php';
require_once __DIR__ . '/../src/CanBeAuthenticatedInterface.php';
require_once __DIR__ . '/../src/Member.php';
require_once __DIR__ . '/../src/AdminLevelEnum.php';
require_once __DIR__ . '/../src/Admin.php';

$member1 = new Member('name_admin', 'admin', 'admin', 32);
$admin1 = new Admin('name_superadmin', 'superadmin', 'superadmin', 56);

var_dump(
    (string) $member1,
    (string) $admin1,
);
