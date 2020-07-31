  <?php include 'inc/header.php'; ?>
  <?php
 if (isset($_GET['delpro'])) {
     $delId = $_GET['delpro'];
     $delProduct = $ct->delProductByCart($delId);
 }
?>



  <?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        
        $updateCart = $ct->updateCartQuantity($cartId, $quantity);
        if ($quantity <= 0) {
            $delProduct = $ct->delProductByCart($cartId);
        }
    }

?>

  <?php
if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/> ";
}
?>
  <div class="container">
  	<div class="main">

  		<div class="cartoption">
  			<div class="cartpage">
  				<h2>Korpa</h2>
  				<?php
         if (isset($updateCart)) {
             echo $updateCart;
         }
        if (isset($delProduct)) {
            echo $delProduct;
        }

            ?>
  				<style>
  					#tblone td {
  						text-align: center;
  					}

  					#tblone tr th {
  						text-align: center;
  						font-weight: bold;
  					}
  				</style>

  				<table id="datatable" class="table table-hover" id="tblone">
  					<thead class="bg-purple bijela">
  						<tr>
  							<th width="5%">Br.</th>
  							<th width="30%">Naziv</th>
  							<th width="10%">Slika</th>
  							<th width="15%">Cijena</th>
  							<th width="15%">Količina</th>
  							<th width="15%">Ukupna cijena</th>
  							<th width="10%">Akcija</th>
  						</tr>
  					</thead>
  					<?php
                    $getPro = $ct->getCartProduct();
                    if ($getPro) {
                        $i = 0;
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getPro->fetch_assoc()) {
                            $i++; ?>
  					<tbody>
  						<tr>
  							<td><?php echo $i; ?>
  							</td>
  							<td class="arial"><?php echo $result['productName']; ?>
  							</td>
  							<td><img src="admin/pages/tables/<?php echo $result['image']; ?>"
  									alt="" height="100px;" width="80px;" /></td>
  							<td class="arial">€ <?php echo $result['price']; ?>
  							</td>
  							<td>
  								<form action="" method="post">
  									<input type="hidden" name="cartId"
  										value="<?php echo $result['cartId']; ?>" />
  									<input type="number" name="quantity"
  										value="<?php echo $result['quantity']; ?>" />
  									<br><br>
  									<button type="submit" name="submit" class="btn btn-info">Ažuriraj</button>
  								</form>
  							</td>
  							<td class="arial">&euro;
  								<?php
                                 $total = $result['price'] * $result['quantity'];
                            echo $total; ?>

  							</td>
  							<td><button type="button" class="btn btn-danger"
  									onclick="delItem('<?php echo $result['cartId']; ?>');"><i
  										class="fa fa-trash"></i>
  								</button>
  							</td>
  						</tr>
  					</tbody>

  					<?php
                                
                            $qty = $qty +  $result['quantity'];
                            $sum = $sum + $total;
                            Session::set("qty", $qty);
                            Session::set("sum", $sum); ?>


  					<?php
                        }
                    }   ?>


  				</table>
  				<?php

                     $getData = $ct->checkCartTable();
                        if ($getData) {
                            ?>
  				<table style="float:right;text-align:left;" width="40%">
  					<tr>
  						<th class="arial">Neto : </th>
  						<td class="arial">&euro; <?php echo $sum; ?>
  						</td>
  					</tr>
  					<tr>
  						<th class="arial">Poštarina : </th>
  						<td class="arial">
  							10%
  						</td>
  					</tr>
  					<tr>
  						<th class="arial">Ukupno :</th>
  						<td class="arial">€ <?php
                            $vat = $sum * 0.1;
                            $gtotal = $sum + $vat;
                            echo $gtotal; ?>
  						</td>
  					</tr>
  				</table>
  				<?php
                        } else { ?>
  				<script>
  					window.location.href = "/"
  				</script>
  				<?php
                            // echo "Cart Empty";
                        } ?>


  			</div>
  			<div class="shopping">
  				<ul class="nav nav-tabs nav-justified">
  					<div class="shopleft">
  						<a href="index.php"><button class="btn btn-warning" type="button">
  								Nastavi kupovinu <span class="glyphicon glyphicon-shopping-cart"></span>
  							</button></a>
  					</div>

  					<div class="shopright">
  						<a href="payment.php"><button class="btn btn-success" type="button">
  								završi kupovinu <span class="glyphicon glyphicon-shopping-cart"></span>
  							</button></a>
  					</div>
  				</ul>
  			</div>
  		</div>
  		<div class="clear"></div>

  	</div>
  </div>


  <?php include 'inc/footer.php';
