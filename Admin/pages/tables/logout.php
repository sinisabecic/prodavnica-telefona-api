<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../../../lib/Session.php');
Session::checkSession();

include_once($filepath.'/../../../lib/Database.php');
include_once($filepath.'/../../../helpers/Format.php');


Session::destroy();
header("Location: ../../login.php");
