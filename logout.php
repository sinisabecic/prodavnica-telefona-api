<?php include '../lib/Session.php';
      include '../classes/Adminlogin.php';


Session::destroy();
header("Location: index.php");
