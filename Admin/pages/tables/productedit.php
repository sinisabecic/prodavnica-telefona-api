<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php include '../../../classes/Product.php';  ?>
<?php include '../../../classes/Category.php';  ?>
<?php include '../../../classes/Brand.php';  ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Izmjena informacija o proizvodu
      <small><?php echo $_SESSION['cmrUser'];
            // !* moze i echo Session::get('cmrUser');
            ?></small>
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">



    <?php
 if (!isset($_GET['proid'])  || $_GET['proid'] == null) {
     echo "<script>window.location = 'productedit.php';  </script>";
 } else {
     $id = $_GET['proid'];
 }

   $pd =  new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
    }

?>


    <?php
if (isset($updateProduct)) {
    echo $updateProduct;
}

?>

    <?php
     $getProd = $pd->getProById($id);
     if ($getProd) {
         while ($value = $getProd->fetch_assoc()) {
             # code...?>

    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">

        <!-- Proizvod -->
        <label for="title">Naziv</label>
        <input type="text" class="form-control" name="productName"
          value="<?php echo $value['productName']; ?>">
      </div>

      <!-- Autor -->
      <div class="form-group">
        <label for=catId>Proizvodjac:</label>
        <select class="form-control" name="catId">

          <?php
             $cat = new Category();
             $getCat =  $cat->getAllCat();
             if ($getCat) {
                 while ($result = $getCat->fetch_assoc()) {
                     ?>

          <option <?php if ($value['catId'] == $result['catId']) { ?>
            selected = "selected"
            <?php } ?> value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?>
          </option>
          <?php
                 }
             } ?>
        </select>
      </div>
      <!-- END autor-->




      <!-- Kategorija -->
      <div class="form-group">
        <label for="brandId">Kategorija:</label>
        <select class="form-control" name="brandId">

          <?php
                $brand = new Brand();
             $getBrand =  $brand->getAllBrand();
             if ($getBrand) {
                 while ($result = $getBrand->fetch_assoc()) {
                     ?>

          <option <?php if ($value['brandId'] == $result['brandId']) { ?>
            selected = "selected"
            <?php } ?> value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?>
          </option>
          <?php
                 }
             } ?>
        </select>
      </div>
      <!-- END Oprem -->


      <!-- OPIS -->
      <div class="form-group">
        <label for="post_content">Opis</label>
        <textarea type="text" class="form-control" name="body" cols="30"
          rows="10"><?php echo  $value['body']; ?></textarea>
      </div>
      <!-- OPIS END -->


      <!-- CIJENA -->
      <div class="form-group">
        <label for="title">Cijena</label>
        <input type="text" class="form-control" name="price"
          value="<?php echo $value['price']; ?>">
      </div>
      <!-- CIJENA END -->


      <div class="form-group">
        <img height="60px;" width="80px;"
          src="<?php echo $value['image']; ?>">
        <span class="btn btn-primary btn-file">Azuriraj sliku
          <input type="file" name="image">
        </span>
      </div>



      <div class="form-group">
        <label for="type">Tip distribucije:</label>
        <select class="form-control" name="type">

          <?php
                if ($value['type'] == 0) { ?>
          <option selected="selected" value="0">Preporučujemo</option>
          <option value="1">Novo u ponudi</option>
          <?php } else {  ?>

          <option value="0">Preporučujemo</option>
          <option selected="selected" value="1">Novo u ponudi</option>
          <?php } ?>
        </select>
      </div>


      <input class="btn btn-success" type="submit" name="submit" value="Sačuvaj">

      <a href="productlist.php"><button type="button" class="btn btn-danger">Odustani</button></a>
    </form>

    <?php
         }
     } ?>

</div>
</div>
</div>



<?php require 'admin-footer.php';
