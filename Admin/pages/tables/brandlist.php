<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php include '../../../classes/Brand.php';  ?>

<?php
 
$brand =  new Brand();
 
if (isset($_GET['delbrand'])) {
    $id = $_GET['delbrand'];
    $delBrand = $brand->delBrandById($id);
}

?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Kategorije
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
          <?php
         if (isset($delBrand)) {
             echo  $delBrand;
         }
          ?>



          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-borderless table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Naziv Kategorije</th>
                  <th>Akcija</th>
                </tr>
              </thead>

              <tbody>
                <?php
             $getBrand = $brand->getAllBrand();
              if ($getBrand) {
                  $i = 0;
                  while ($result = $getBrand->fetch_assoc()) {
                      $i++; ?>

                <tr>
                  <td><?php echo $i; ?>
                  </td>
                  <td><?php echo $result['brandName']; ?>
                  </td>
                  <td><a
                      href="brandedit.php?brandid=<?php echo $result['brandId']; ?>"><button
                        type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                    || <a onclick="return confirm('Da li ste sigurni?')"
                      href="?delbrand=<?php echo $result['brandId']; ?>"><button
                        type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                </tr>

                <?php
                  }
              }  ?>

              </tbody>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>

  <?php include 'admin-footer.php';
