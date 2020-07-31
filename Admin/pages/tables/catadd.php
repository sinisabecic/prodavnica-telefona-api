<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php';?>
<?php include '../../../classes/Category.php';  ?>

<?php 
   $cat =  new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        
        $insertCat = $cat->catInsert($catName);
    }

?>




    <div class="content-wrapper"><!-- Odavde -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dodavanje proizvodjaca
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
                    if (isset($insertCat)) {
                        echo $insertCat;
                    }
              ?>



                 <form action=" " method="post">
                    <div class="form-group">                  			
                    <input type="text" name="catName" placeholder="Ime proizvodjaca" class="form-control" />
                    </div>      
                       
                <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Dodaj">

                <a href="catlist.php"><button type="button" class="btn btn-danger">Odustani</button></a>
                </div>
                           
                </form>


                </div>
            <!-- /.box-body -->
         
          <!-- /.box -->
        </div>
       
        </section>
   
  </div>
<?php include 'admin-footer.php';?>