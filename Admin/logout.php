<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Session.php');
Session::checkAdmin();

include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');


Session::destroy();
echo '<script type="text/javascript">
            window.location.href = "/";
            </script>';
