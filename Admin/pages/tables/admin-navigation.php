<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>n</b>Mob</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>N-</b>Mobile</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <?php
                if ($msg->count() > 0) { ?>
              <span class="label label-success"><?php echo $msg->count(); ?></span>
              <?php
              } ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Imate <strong><?php echo $msg->count(); ?></strong>
                nove poruke.</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
$getAllMessages = $msg->getUnreadMessages();
while ($result  = $getAllMessages->fetch_assoc()) {
    ?>
                  <!-- start message -->
                  <li>
                    <a href="messages.php">
                      <div class="pull-left">
                        <img src="../../images/avatar.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php echo $result['name']; ?>
                        <small><i class="fa fa-clock-o"></i> <?php echo $result['date']; ?></small>
                      </h4>
                      <p><?php echo $result['message']; ?>
                      </p>
                    </a>
                  </li>
                  <!-- end message -->
                  <?php
} ?>
                </ul>
              </li>
              <li class="footer"><a href="messages.php">Pročitajte sve poruke</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->


          <li class="dropdown">
            <a href="/">
              <i class="fa fa-shopping-cart"></i> Prodavnica
            </a>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['cmrName'];
            // !* moze i echo Session::get('cmrName');
            ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['cmrName'];
            // !* moze i echo Session::get('cmrName');
            ?>
                </p>
              </li>

              <!-- Menu Sign out-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-danger" type="button">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Odjava
                  </a>
                </div>
              </li>
            </ul>

            <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->