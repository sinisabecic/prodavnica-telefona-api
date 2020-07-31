<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php
 $filepath = realpath(dirname(__FILE__));
include_once('../../../classes/User.php');

?>


<?php
  if (!isset($_GET['custId'])  || $_GET['custId'] == null) {
      echo "<script>window.location = 'mainorder.php';  </script>";
  } else {
      $id = $_GET['custId'];
  }

 ?>



<?php
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'mainorder.php';  </script>";
    }

?>




<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Klijent
      <small><?php echo $_SESSION['cmrUser'];
            // !* moze i echo Session::get('cmrUser');
            ?></small>
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">


            <?php

        $user = new User();
        $getUsers = $user->getUserData($id);
        if ($getUsers) {
            while ($result = $getUsers->fetch_assoc()) {
                ?>

            <form action="" method="POST">

              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-light" type="button">Ime klijenta</button>
                    </span>
                    <input type="text" class="form-control" readonly
                      value="<?php echo($result['name']) ?>">
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->

                <div class="col-lg-6">
                  <div class="input-group">
                    <input type="text" class="form-control" readonly
                      value="<?php echo($result['address']) ?>">
                    <span class="input-group-btn">
                      <button class="btn btn-light" type="button">Adresa</button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
              </div><!-- /.row -->
              <br>
              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-light" type="button">Grad</button>
                    </span>
                    <input type="text" class="form-control" readonly
                      value="<?php echo($result['city']) ?>">
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="input-group">
                    <input type="text" class="form-control" readonly
                      value="<?php echo($result['country']) ?>">
                    <span class="input-group-btn">
                      <button class="btn btn-light" type="button">Zemlja</button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
              </div><!-- /.row -->
              <br>
              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-light" type="button">Poštanski broj</button>
                    </span>
                    <input type="text" class="form-control" readonly
                      value="<?php echo($result['zip']) ?>">
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                  <div class="input-group">
                    <input type="text" class="form-control" readonly
                      value="<?php echo($result['phone']) ?>">
                    <span class="input-group-btn">
                      <button class="btn btn-light" type="button">Telefon</button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
              </div><!-- /.row -->
              <br>

              <div class="row">
                <div class="col-lg-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-light" type="button">@</button>
                    </span>
                    <input type="text" class="form-control" readonly
                      value="<?php echo($result['email']) ?>">
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->

              </div><!-- /.row --><br>
              <div class="form-group">
                <a href="mainorder.php"><button class="btn btn-primary" type="button">U redu</button></a>
              </div>



            </form>
            <?php
            }
        }  ?>


          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box -->
    </div>
  </section>
</div>



<?php include 'admin-footer.php';
