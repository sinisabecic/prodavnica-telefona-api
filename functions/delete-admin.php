<?php

require '../classes/User.php';

$user = new User();

$admin_id = $_POST['admin_id'];

$result = $user->deleteAdmin($admin_id);
