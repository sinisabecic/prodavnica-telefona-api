<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php include '../../../classes/Product.php';  ?>
<?php include_once '../../../helpers/Format.php';?>

<?php
$pd = new Product();
$fm = new Format();

?>


<?php
 if (isset($_GET['delpro'])) {
     $id = $_GET['delpro'];
     $delpro = $pd->delPorById($id);
 }

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Telefoni i oprema
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
         if (isset($delpro)) {
             echo  $delpro;
         }
          ?>


          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-striped table-bordered table-hover">

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Naziv</th>
                  <th>Proizvodjac</th>
                  <th>Kategorija</th>
                  <th>Opis</th>
                  <th>Cijena</th>
                  <th>Slika</th>
                  <th style="text-align: center;">Tip</th>
                  <th style="text-align: center;">Akcija</th>
                </tr>
              </thead>
              <tbody>
                <?php
           $getPd = $pd->getAllProduct();
           if ($getPd) {
               $i = 0;
               while ($result = $getPd->fetch_assoc()) {
                   $i++; ?>


                <tr>
                  <td><?php echo $i; ?>
                  </td>
                  <td><strong>
                      <a target="__blank"
                        href="../../../preview.php?proid=<?php echo $result['productId']; ?>">
                        <?php echo $fm->textShorten($result['productName'], 25); ?>
                      </a>
                    </strong>
                  </td>
                  <td><?php echo $result['catName']; ?>
                  </td>
                  <td><?php echo $result['brandName']; ?>
                  </td>
                  <td><?php echo $fm->textShorten($result['body'], 15); ?>
                  </td>
                  <td><?php echo $result['price']; ?>
                  </td>
                  <td><img
                      src="<?php echo $result['image']; ?>"
                      height="40px;" width="60px;"></td>
                  <td style="text-align: center;"><?php

                    if ($result['type'] == 0) { ?>
                    <span class="badge bg-orange">Preporucujemo</span>
                    <?php   } else { ?>
                    <span class="badge bg-green">Novo u ponudi</span>
                    <?php	} ?>
                  </td>
                  <td style="text-align: center;">
                    <a
                      href="productedit.php?proid=<?php echo $result['productId']; ?>">
                      <button type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>
                    || <a onclick="return confirm('Da li ste sigurni?')"
                      href="?delpro=<?php echo $result['productId']; ?>"><button
                        type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
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
