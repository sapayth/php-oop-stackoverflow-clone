<?php

namespace Src\Role_Permission;

use Src\Authentication\FaiyazRoleBasedAuth;

include_once '../../autoload.php';

$user = new FaiyazRoleBasedAuth;
$login = $user->login('Admin', 'Pass1436');

