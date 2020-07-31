<?php require 'db.php'; ?>
<!-- OVDJE SAM DEKLARISAO USLOV, DA SAMO ADMIN MOZE DA PRISTUPI CMS-U -->
<?php include '../lib/Session.php';  ?>

<?php Session::checkSession(); ?>

