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
   $pd =  new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertProduct = $pd->productInsert($_POST, $_FILES);
    }

?>


        <?php
if (isset($insertProduct)) {
    echo $insertProduct;
}

?>



        <form action="" method="post" enctype="multipart/form-data">


            <div class="form-group">
                <label for="title">Naziv</label>
                <input type="text" class="form-control" name="productName">
            </div>




            <!-- Proizvodjac -->
            <div class="form-group">
                <label for="catId">Proizvodjac:</label>
                <select class="form-control" name="catId">

                    <?php
                    $cat = new Category();
                    $getCat =  $cat->getAllCat();
                    if ($getCat) {
                        while ($result = $getCat->fetch_assoc()) {
                            ?>

                    <option selected="selected"
                        value="<?php echo $result['catId']; ?>">
                        <?php echo $result['catName']; ?>
                    </option>
                    <?php
                        }
                    } ?>
                </select>
            </div>
            <!-- END Proizvodjac-->





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

                    <option selected="selected"
                        value="<?php echo $result['brandId']; ?>">
                        <?php echo $result['brandName']; ?>
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
                <textarea type="text" class="form-control" name="body" cols="30" rows="10"></textarea>
            </div>
            <!-- OPIS END -->



            <!-- CIJENA -->
            <div class="form-group">
                <label for="title">Cijena</label>
                <input type="text" class="form-control" name="price">
            </div>
            <!-- CIJENA END -->


            <!-- SLIKA -->
            <div class="form-group">
                <img height="60px;" width="80px;">
                <span class="btn btn-primary btn-file">Dodaj sliku
                    <input type="file" name="image">
                </span>
            </div>

            <div class="form-group">
                <label for=brandId>Tip distribucije:</label>
                <select class="form-control" name="type">

                    <?php
                if ($value['type'] == 0) { ?>
                    <option selected="selected" value="0">Preporucujemo</option>
                    <option value="1">Novo u ponudi</option>
                    <?php } else {  ?>

                    <option value="0">Preporucujemo</option>
                    <option selected="selected" value="1">Novo u ponudi</option>
                    <?php }  ?>
                </select>
            </div>


            <input class="btn btn-success" type="submit" name="submit" value="sačuvaj">

            <a href="productlist.php"><button type="button" class="btn btn-danger">Odustani</button></a>
        </form>
</div>
</div>
</div>

<!-- Load TinyMCE -->
<?php include 'admin-footer.php';
