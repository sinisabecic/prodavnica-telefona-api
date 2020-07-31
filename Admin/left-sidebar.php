<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->

  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
      </div>


      <div class="pull-left info">
        <p><?php echo $session::get('cmrName'); ?>
        </p>
        <?php if (Session::get('cuslogin')) { ?>
        <a href="#"><i class="fa fa-circle text-success"></i> Na mreži</a>
        <?php
      } else { ?>
        <a href="#"><i class="fa fa-circle text-danger"></i> Van mreže</a>
        <?php
        }
        ?>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->




    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">


      <li class="header">GLAVNA NAVIGACIJA</li>

      <li class="active">
        <a href="/admin">
          <i class="fa fa-dashboard"></i> <span>Komandna tabla</span>
        </a>
      </li>



      <!-- Korisnici -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i> <span>Korisnici</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/tables/users.php"><i class="fa fa-circle-o"></i> Lista korisnika</a></li>
          <li><a href="pages/tables/add_user.php"><i class="fa fa-circle-o"></i> Dodaj korisnika</a></li>
        </ul>
      </li>



      <!-- Proizvodjaci -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-apple"></i> <span>Proizvođači</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/tables/catlist.php"><i class="fa fa-circle-o"></i> Lista proizvođača</a></li>
          <li><a href="pages/tables/catadd.php"><i class="fa fa-circle-o"></i> Dodaj proizvođača</a></li>
        </ul>
      </li>



      <!-- Kategorije -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-stack-overflow"></i> <span>Kategorije</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/tables/brandlist.php"><i class="fa fa-circle-o"></i> Lista kategorija</a></li>
          <li><a href="pages/tables/brandadd.php"><i class="fa fa-circle-o"></i> Dodaj</a></li>
        </ul>
      </li>


      <!-- Telefoni i oprema -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-mobile"></i> <span>Telefoni i oprema</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/tables/productlist.php"><i class="fa fa-circle-o"></i> Lista telefona i opreme</a></li>
          <li><a href="pages/tables/productadd.php"><i class="fa fa-circle-o"></i> Dodaj</a></li>
        </ul>
      </li>




      <!-- Slajder -->
      <li class="">
        <a href="pages/tables/sliderlist.php">
          <i class="fa fa-slideshare"></i> <span>Slajder proizvoda</span>
        </a>
      </li>



      <!-- Porudzbine -->
      <?php
          $getOrder = $ct->getOrdersAlert(); //"SELECT * FROM tbl_order WHERE status = 0 ";
                    
          if ($getOrder) { ?>
      <li class="">
        <a href="/admin/pages/tables/mainorder.php">
          <i class="fa fa-cc-visa"></i> <span>Porudžbine</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red">
              <?php echo $getOrder; ?>
            </small>
          </span>
        </a>
      </li>

      <?php } else { ?>
      <li class="">
        <a href="/admin/pages/tables/mainorder.php">
          <i class="fa fa-cc-visa"></i> <span> Porudžbine</span></a>
        <span class="pull-right-container">
        </span>
      </li>
      <?php }  ?>


      <!-- Prijemno sanduče -->
      <?php
          $getMsg = $ct->getMessagesAlert(); //"SELECT * FROM tbl_order WHERE status = 0 ";
                    
          if ($getMsg) { ?>
      <li class="">
        <a href="pages/tables/messages.php">
          <i class="fa fa-envelope"></i> <span>Prijemno sanduče</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red">
              <?php echo $getMsg; ?>
            </small>
          </span>
        </a>
      </li>

      <?php } else { ?>

      <li class="">
        <a href="pages/tables/messages.php">
          <i class="fa fa-envelope"></i> <span>Prijemno sanduče</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <?php } ?>

      <!-- Sajt -->
      <li class="">
        <a href="/" target="__blank">
          <i class="fa fa-shopping-cart"></i> <span>Prodavnica</span>
        </a>
      </li>


  </section>
  <!-- /.sidebar -->
</aside>