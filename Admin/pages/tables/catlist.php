<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php';?>
<?php include '../../../classes/Category.php';  ?>

<?php
 
$cat =  new Category();
 
if (isset($_GET['delcat'])) {
    $id = $_GET['delcat'];
    $delCat = $cat->delCatById($id);
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Proizvođači
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
         if (isset($delCat)) {
             echo  $delCat;
         }
          ?>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-stripped table-borderless table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Proizvođač</th>
                  <th>Akcija</th>
                </tr>
              </thead>

              <tbody>

                <?php
         $getCat = $cat->getAllCat();
          if ($getCat) {
              $i = 0;
              while ($result = $getCat->fetch_assoc()) {
                  $i++; ?>

                <tr>
                  <td><?php echo $i; ?>
                  </td>
                  <td><strong>
                      <a target="__blank"
                        href="../../../category.php?id=<?php echo $result['catId']; ?>">
                        <?php echo $result['catName']; ?>
                      </a>
                  </td>
                  <td><a
                      href="catedit.php?catid=<?php echo $result['catId']; ?>">
                      <button type="button" class="btn btn-primary"><i class="fa fa-pencil"
                          aria-hidden="true"></i></button>
                    </a>
                    || <a onclick="return confirm('Da li ste sigurni?')"
                      href="?delcat=<?php echo $result['catId']; ?>"><button
                        type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                    </strong>
                  </td>
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
  </section>
  <?php include 'admin-footer.php';
