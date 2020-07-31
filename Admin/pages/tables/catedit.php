<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php';?>
<?php include '../../../classes/Category.php';  ?>


<div class="content-wrapper"><!-- Odavde -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Izmjena proizvodjaca
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
  if (!isset($_GET['catid'])  || $_GET['catid'] == NULL ) {
     echo "<script>window.location = 'catlist.php';  </script>";
  }else {
    $id = $_GET['catid'];
    

  }

 ?>



<?php 
   $cat =  new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        
        $updateCat = $cat->catUpdate($catName, $id);
    }

?>        
              <?php
                    if (isset($updateCat)) {
                        echo $updateCat;
                    }
              ?>

     
          

     <?php 
        $getCat = $cat->getCatById($id);
        if ($getCat) {
           while ($result = $getCat->fetch_assoc()) {
           
     ?>


     
           <form action=" " method="post" >
            <div class="form-group">     
             <input value="<?php echo $result['catName']; ?>" type="text" class="form-control" name="catName">
            </div>

			
            <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_category" value="Azuriraj">

          <a href="catlist.php"><button type="button" class="btn btn-danger">Odustani</button></a>
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