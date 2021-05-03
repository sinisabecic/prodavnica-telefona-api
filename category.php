<?php include 'inc/header.php';?>

<?php
$id = $_GET['id'];
?>

<div class="container">
    <div class="main">

        <!-- Svi  proizvodi  -->
        <div class="content_top">
            <?php $catById = $cat->getCatById($id);
while ($result = $catById->fetch_assoc()) {
    ?>

            <p class="h2 purple"><?php echo $result['catName']; ?>
                proizvodi</p>
            <?php
}?>

            <p class="text-muted">Naša ponuda</p>
            <hr>
            <div class="clear"></div>
        </div>
        <div class="section group">

            <?php
$productbycat = $pd->productByCat($id);
if ($productbycat) {
    while ($result = $productbycat->fetch_assoc()) {
        ?>
            <div class="grid_1_of_4 images_1_of_4 hvr-float">
                <a href="preview.php?proid=<?php echo $result['productId']; ?>">
                    <img id="img01" src="admin/pages/tables/<?php echo $result['image']; ?>" alt="" /></a>

                <h1 class="product-name arial w-600">
                    <?php echo $result['productName']; ?>
                </h1>

                <p><?php echo $fm->textShorten($result['body'], 60); ?>
                </p>
                <p><span class="price"> &euro; <?php echo $result['price']; ?></span>
                </p>

                <a href="preview.php?proid=<?php echo $result['productId']; ?>" class="details"><input
                        style="font-size:13px;" class="btn btn-primary2" type="button" value="Detalji"></a></span>
            </div>

            <?php
}
} else {
    ?>
            <div class='alert alert-warning' role='alert'>Traženi proizvodi željenog proizvođača nisu pronađeni.</div>


            <?php	}?>

        </div>

    </div>
</div>

<?php include 'inc/footer.php';