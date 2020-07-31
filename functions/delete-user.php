<?php

require '../classes/User.php';

$user = new User();

$user_id = $_POST['user_id'];

$result = $user->deleteUser($user_id);
