<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>

<?php
 $filepath = realpath(dirname(__FILE__));
include_once('../../../classes/Cart.php');
$ct = new Cart();
$fm = new Format();
?>


<?php
 if (isset($_GET['shiftid'])) {
     $id = $_GET['shiftid'];
     $price = $_GET['price'];
     $time = $_GET['time'];
     $shift = $ct->productShifted($id, $time, $price);
 }


  if (isset($_GET['delproid'])) {
      $id = $_GET['delproid'];
      $price = $_GET['price'];
      $time = $_GET['time'];
      $delOrder = $ct->delproductShifted($id, $time, $price);
  }


?>



<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Porudzbine
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
         if (isset($shift)) {
             echo $shift;
         }

          if (isset($delOrder)) {
              echo $delOrder;
          }
?>


					<!-- /.box-header -->
					<div class="box-body">
						<table id="example" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Br.</th>
									<th>Datum porudzbine</th>
									<th>Proizvod</th>
									<th>Kolicina</th>
									<th>Cijena</th>
									<th>ID Klijenta</th>
									<th class="text-center">Adresa</th>
									<th class="text-center">Status</th>
									<th class="text-center">Akcija</th>
								</tr>
							</thead>
							<tbody>

								<?php
                        
                        $getOrder = $ct->getAllOrderProduct();
                        if ($getOrder) {
                            while ($result = $getOrder->fetch_assoc()) {
                                ?>

								<tr>
									<td><?php echo $result['o_id']; ?>
									</td>
									<td><?php echo  $fm->formatDate($result['date']); ?>
									</td>
									<td><a target="__blank"
											href="../../../preview.php?proid=<?php echo $result['productId']; ?>">
											<?php echo $fm->textShorten($result['productName'], 25); ?></a>
									</td>
									<td><?php echo $result['quantity']; ?>
									</td>
									<td><?php echo $result['price']; ?>
										€</td>
									<td><?php echo $fm->textShorten($result['cmrId'], 10); ?>
									</td>
									<td class="text-center"><a
											href="customer.php?custId=<?php echo $result['cmrId']; ?>">
											<button type="button" class="btn btn-light">Vidi adresu</button></a></td>

									<?php if ($result['status'] == '0') { ?>
									<td class="text-center">
										<span class="badge bg-orange">Neisporučeno</span>
									</td>
									<td class="text-center"><a
											href="?shiftid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">
											<button type="button" class="btn btn-success"><i class="fa fa-check"
													aria-hidden="true"></i></button></a>
									</td>
									<?php	} else {    ?>
									<td class="text-center">
										<span class="badge bg-green">Isporučeno</span>
									</td>
									<td class="text-center">
										<a
											href="?delproid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">
											<button type="button" class="btn btn-danger"><i class="fa fa-trash"
													aria-hidden="true"></i></button>
										</a>
									</td>
									<?php } ?>


								</tr>

								<?php
                            }
                        }  ?>

							</tbody>
						</table>


					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</section>

	<?php include 'admin-footer.php';
