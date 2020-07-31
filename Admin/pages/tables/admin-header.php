<?php require 'db.php'; ?>
<?php include '../../../lib/Session.php';
include '../../../lib/Database.php';

spl_autoload_register(function ($class) {
    include_once "../../../classes/".$class.".php";
});

$ct = new Cart();
$msg = new Contact();
$fm = new Format();

Session::checkAdmin(); ?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Prodavnica | Admin</title>

  <link rel="shortcut icon" type="image/png" href="../../../images/admin.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


  <!-- Bootstrap 4.0 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.2/css/froala_editor.pkgd.min.css" rel="stylesheet"
    type="text/css" />
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.0.2/js/froala_editor.pkgd.min.js">
  </script>

  <link href="../../dist/css/style.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.css" />

  <link href="../../dist/css/jquery.toast.css" rel="stylesheet" type="text/css" />
</head>


<body class="hold-transition skin-blue sidebar-mini">