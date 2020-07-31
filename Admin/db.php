<?php 
// drugi nacin, eto zbog nekih trikova kao 
$db['db_host'] = 'localhost'; 
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'db_store';

	foreach ($db as $key => $value) { // db se pretvara u key, a key je jednak vrijednosti, npr $db['db_host'] je key cija je vrijednost localhost
		
		define(strtoupper($key), $value);
	}

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (!$conn) {

		echo 'Error' . mysqli_error();
		
	}