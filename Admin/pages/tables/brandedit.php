<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php include '../../../classes/Brand.php';  ?>

<div class="content-wrapper"><!-- Odavde -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Izmjena Kategorije
        <small><?php echo $_SESSION['cmrUser'];
            // !* moze i echo Session::get('cmrUser');
            ?></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
 <?php
  if (!isset($_GET['brandid'])  || $_GET['brandid'] == NULL ) {
     echo "<script>window.location = 'catlist.php';  </script>";
  }else {
    $id = $_GET['brandid'];

  }

 ?>



<?php 
   $brand =  new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        
        $updateBrand = $brand->brandUpdate($brandName, $id);
    }

?>

              <?php
                    if (isset($updateBrand)) {
                        echo $updateBrand;
                    }
              ?>

     

     <?php 
        $getBrand = $brand->getUpdatetById($id);
        if ($getBrand) {
           while ($result = $getBrand->fetch_assoc()) {
           
     ?>

       <form action=" " method="post">
          <div class="form-group">     
               <input value="<?php echo $result['brandName']; ?>" type="text" class="form-control" name="brandName">
              </div>
          
          <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_category" value="Azuriraj">

          <a href="brandlist.php"><button type="button" class="btn btn-danger">Odustani</button></a>
           </div>
                    </form>
                    <?php    }  }  ?>


                </div>
            <!-- /.box-body -->
         
          <!-- /.box -->
        </div>
       
        </section>
   
  </div>
<?php include 'admin-footer.php';?>