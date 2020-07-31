<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php include '../../../classes/Product.php';  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Slajder
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
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-bordered table-hover">

              <thead>
                <tr>
                  <th>Naslov</th>
                  <th>Proizvodi na slajderu</th>
                </tr>
              </thead>
              <tbody>
                <?php
           $brand =  new Product();
           $getIm = $brand->getAllProductImageSlider();
           if ($getIm) {
               $i = 0;
               while ($result = $getIm->fetch_assoc()) {
                   ?>


                <tr>
                  <td><?php echo $result['productName']; ?>
                  </td>
                  <td><img
                      src="<?php echo $result['image']; ?>"
                      height="40px;" width="60px;"></td>

                </tr>

                <?php
               }
           } ?>
              </tbody>
            </table>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
      <!-- /.row -->
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?php include 'admin-footer.php';
