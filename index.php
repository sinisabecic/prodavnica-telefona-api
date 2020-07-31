 <?php include 'inc/header.php'; ?>
 <?php include 'inc/slider.php'; ?>
 <br><br>

 <div class="container">

 	<div class="content_top">

 		<p class="h2 purple">Preporučujemo</p>
 		<p class="text-muted">Izdvajamo iz ponude</p>
 		<hr>
 		<div class="clear"></div>
 	</div>
 	<div class="section group">
 		<?php
            $getFpd = $pd->getFeaturedProduct();
            if ($getFpd) {
                while ($result = $getFpd->fetch_assoc()) {
                    ?>


 		<div class="grid_1_of_4 images_1_of_4 hvr-float" width: 170px; height: 370px;>
 			<a
 				href="preview.php?proid=<?php echo $result['productId']; ?>">
 				<img src="admin/pages/tables/<?php echo $result['image']; ?>"
 					alt="" /></a>
 			<h2 class="text-center text-uppercase font-weight-bolder purple" style="margin-top:8px;">
 				<?php echo $result['productName']; ?>
 			</h2>
 			<p><?php echo $fm->textShorten($result['body'], 60); ?>
 			</p>
 			<p><span style="color: #000;" class="price arial"><?php echo $result['price']; ?>
 					€</span></p>

 			<a
 				href="preview.php?proid=<?php echo $result['productId']; ?>">
 				<input class="btn btn-secondary" type="button" value="Detalji">
 			</a>
 		</div>

 		<?php
                }
            }  ?>
 	</div>


 	<div class="content_bottom">
 		<p class="h2 purple">Novo u ponudi</p>
 		<p class="text-muted">Nova kolekcija</p>
 	</div>
 	<div class="section group">

 		<?php
            $getNpd = $pd->getNewProduct();
            if ($getNpd) {
                while ($result = $getNpd->fetch_assoc()) {
                    ?>
 		<div class="grid_1_of_4 images_1_of_4 hvr-float">
 			<a
 				href="preview.php?proid=<?php echo $result['productId']; ?>">
 				<img src="admin/pages/tables/<?php echo $result['image']; ?>"
 					alt="" /></a>
 			<h2 style="margin-top:8px;" class="text-center text-uppercase font-weight-bolder purple"><?php echo $result['productName']; ?>
 			</h2>
 			<p><span style="color: #000;" class="price"><?php echo $result['price']; ?>
 					€</span></p>
 			<br>
 			<a
 				href="preview.php?proid=<?php echo $result['productId']; ?>">
 				<input class="btn btn-secondary" type="button" value="Detalji">
 			</a>

 		</div>

 		<?php
                }
            }  ?>



 	</div>
 </div>


 <?php include 'inc/footer.php';
