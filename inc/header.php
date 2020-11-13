<?php
 include 'inc/countries.php';
 include 'lib/Session.php';

 
  Session::init();  // Mora stojati iznad HTML-a
 

 include 'lib/Database.php';
 include 'helpers/Format.php';
  


  spl_autoload_register(function ($class) {
      include_once "classes/".$class.".php";
  });

  $db = new Database();
  $fm = new Format();
  $pd = new Product(); // Proizvod
  $cat = new Category(); // Proizvodjac
  $ct = new Cart();
  $cmr = new User();
  $con = new Contact();
    
?>

<!DOCTYPE html>
<html>

<head>
  <title>Prodavnica</title>
  <link rel="shortcut icon" type="image/png" href="images/icon.png">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <!-- Google Font -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/jquery.toast.css">
  <link href="css/hover.css" rel="stylesheet" media="all">
  <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
  <script src="js/jquerymain.js"></script>
  <script src="js/script.js" type="text/javascript"></script>
  <!-- <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> -->
  <script type="text/javascript" src="js/nav.js"></script>
  <script type="text/javascript" src="js/move-top.js"></script>
  <script type="text/javascript" src="js/easing.js"></script>
  <script type="text/javascript" src="js/nav-hover.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function($) {
      $('#dc_mega-menu-orange').dcMegaMenu({
        rowItems: '4',
        speed: 'fast',
        effect: 'fade'
      });
    });
  </script>
</head>

<body>

  <nav class="navbar navbar-expand flex-column flex-md-row bd-navbar sticky-top">
    <div class="container-lg">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">
              <button type="button" class="btn btn-primary2">
                Početna
              </button>
            </a>
          </li>

          <li class="nav-item">
            <div class="dropdown">
              <a class="nav-link" href="#">
                <button type="button" class="btn btn-primary2">Proizvođači</button>
                <div class="dropdown-content">
                  <a href="/products.php">Svi proizvodi</a>
                  <?php
                $getCat = $cat->getAllCat();
                while ($result = $getCat->fetch_assoc()) {
                    ?>
                  <a
                    href="/category.php?id=<?php echo $result['catId']; ?>">
                    <?php echo $result['catName']; ?>
                  </a>
                  <?php
                } ?>
                </div>
              </a>
            </div>
          </li>


          <li class="nav-item">
            <!-- Korpa i placanje -->
            <?php
              $chkCart = $ct->checkCartTable();
              if ($chkCart) { ?>
            <a class="nav-link" href="cart.php">
              <button type="button" class="btn btn-primary2">
                Korpa
              </button>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="payment.php">
              <button type="button" class="btn btn-primary2">
                Plaćanje
              </button>
            </a>
          </li>

          <?php  }  ?>

          <!-- Profil -->
          <li class="nav-item">
            <?php
          /*  $login =  Session::get("cuslogin");
            if ($login == true) { ?>
            <a class="nav-link" href="profile.php">
              <button type="button" class="btn btn-primary2">
                Profil
              </button>
            </a>
            <?php } 	*/?>
          </li>


          <li class="nav-item"><?php
          if (isset($_SESSION['cuslogin'])) {
              ?>
            <a class="nav-link" href="wishlist.php">
              <button type="button" class="btn btn-primary2">
                Lista želja
              </button>
            </a>
            <?php
          } ?>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="contact.php">
              <button type="button" class="btn btn-primary2">
                Kontakt
              </button>
            </a>
          </li>
        </ul>



        <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
          <ul class="navbar-nav mr-auto">

            <?php
if (Session::get('cuslogin')) { ?>
            <li class="nav-item nav-link">
              <div class="btn-group">
                <button type="button" class="btn btn-primary3 dropdown-toggle" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-fw fa-user"></i> <?php echo Session::get("cmrUser"); ?>
                </button>
                <div class="dropdown-menu">

                  <a class="dropdown-item" href="/profile.php">
                    <i class="fa fa-user-circle" aria-hidden="true"></i> Profil</a>


                  <a class="dropdown-item" href="/wishlist.php">
                    <i class="fa fa-heart" aria-hidden="true"></i> Lista želja</a>


                  <?php
if (Session::get('is_admin') == 1) { ?>
                  <a class="dropdown-item" href="/admin">
                    <i class="fa fa-id-card-o" aria-hidden="true"></i> Administracija</a>
                  <?php } ?>


                  <div class="dropdown-divider"></div>

                  <?php
       if (isset($_GET['cid'])) {
           $cmrId =  Session::get("cmrId");
           $delDate = $ct->delCustomerCart();
           $delComp = $pd->delCompareData($cmrId);
           Session::destroy(); //! Za odjavu
       }

            
              if (Session::get("cuslogin") == true) { ?>
                  <a class="dropdown-item"
                    href="?cid=<?php Session::get('cmrId') ?>">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    Odjavi se</a>
                  <?php } ?>
                </div>
              </div>
            </li>


            <?php } else { ?>
            <li class="nav-item">

              <a class="nav-link" href="/login.php">
                <button type="button" class="btn btn-primary2">
                  <i class="fa fa-fw fa-user"></i>Prijava
                </button>
              </a>
            </li>
            <?php } ?>


            <li class="nav-item">
              <a class="nav-link arial" href="/cart.php">
                <button class="btn btn-success" type="button">
                  <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                  <?php
                $getData = $ct->checkCartTable();
                if ($getData) {
                    $sum = Session::get("sum");
                    $qty = Session::get("qty");
                    echo " " .$sum ." €";	//" Kol. ".$qty;
                } else {
                    echo " 0 €";
                }
                ?>
                </button>
              </a>
            </li>

            <li class="nav-item nav-link">
              <input class="form-control mr-sm-2" name="search" type="text" id="mySearch" onkeyup="myFunction()"
                placeholder="Nađi proizvode...">
              <button class="btn my-2 my-sm-0 btn-light" type="submit">
              <i class="fa fa-fw fa-search"></i></button>
            </li>

          </ul>
        </form>

      </div>
    </div>
  </nav>