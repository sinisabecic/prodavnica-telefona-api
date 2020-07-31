<?php include '../lib/Session.php';  ?>
<?php include '../classes/User.php';  ?>


<?php



    $login =  Session::get("cuslogin");
    if ($login == true) {
        header("Location: admin/index.php");
    } else {
        header("Location: ../index.php");
    }
