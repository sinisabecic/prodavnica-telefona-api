<?php

require '../classes/Contact.php';

$user = new Contact();

$message_id = $_POST['message_id'];

$result = $user->deleteMessage($message_id);
