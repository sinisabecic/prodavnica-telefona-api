 <?php include 'inc/header.php'; ?>

 <?php
  if (!isset($_GET['search'])  || $_GET['search'] == null) {
      echo "<script>window.location = '404.php';  </script>";
  } else {
      $search = $_GET['search'];
  }

 ?>

 <div class="container">
 	<div class="main">

 		<div class="heading">

 		</div>
 		<div class="clear"></div>
 		<div class="section group">

 			<?php
          $productbysearch = $pd->productBySearch($search);
          if ($productbysearch) {
              while ($result = $productbysearch->fetch_assoc()) {
                  ?>
 			<div class="grid_1_of_4 images_1_of_4">
 				<a
 					href="preview.php?proid=<?php echo $result['productId']; ?>">
 					<img src="admin/pages/tables/<?php echo $result['image']; ?>"
 						alt="" /></a>
 				<h2><?php echo $result['productName']; ?>
 				</h2>
 				<p><?php echo $fm->textShorten($result['body'], 60); ?>
 				</p>
 				<p><span class="price">$<?php echo $result['price']; ?></span>
 				</p>

 				<a href="preview.php?proid=<?php echo $result['productId']; ?>"
 					class="details"><input style="font-size:13px;" class="btn btn-primary3" type="button"
 						value="Detalji"></a></span>
 			</div>




 			<?php
              }
          } else { ?>


 			<div class='alert alert-warning' role='alert'>Traženi proizvod nije pronađen.</div>

 			<?php	}  ?>

 		</div>

 	</div>
 </div>

 <?php include 'inc/footer.php';
