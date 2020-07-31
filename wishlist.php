  <?php include 'inc/header.php'; ?>
  <?php
  $cmrId =  Session::get("cmrId");
  $login =  Session::get("cuslogin");
  if ($login == false) {
      header("Location:login.php");
  }

  ?>


  <?php
  if (isset($_GET['delwlistid'])) {
      $productId = $_GET['delwlistid'];
      $delWlist = $pd->delWlistData($cmrId, $productId);
  }
 ?>
  <style>
  	#tblone td {
  		text-align: center;
  	}

  	#tblone tr th {
  		text-align: center;
  	}
  </style>
  <div class="container">
  	<div class="main">

  		<div class="cartoption">
  			<div class="cartpage">
  				<p class="h2 purple"> Lista želja</p>
  				<hr>

  				<table id="example" class="table table-bordered table-hover" id="tblone">
  					<thead>
  						<tr>
  							<th width="5%">Id</th>
  							<th width="30%">Proizvod</th>
  							<th width="10%">Slika</th>
  							<th width="15%">Cijena</th>
  							<th width="10%">Akcija</th>
  						</tr>
  					</thead>
  					<?php
                    $cmrId =  Session::get("cmrId");
                    $getPd = $pd->checkWlistData($cmrId);
                    if ($getPd) {
                        $i = 0;
                         
                        while ($result = $getPd->fetch_assoc()) {
                            $i++; ?>
  					<tr>
  						<td><?php echo $i; ?>
  						</td>
  						<td><a
  								href="preview.php?proid=<?php echo $result['productId']; ?>">
  								<?php echo $result['productName']; ?>
  							</a>
  						</td>
  						<td><img src="admin/pages/tables/<?php echo $result['image']; ?>"
  								height="100px;" width="80px;" alt="" /></td>
  						<td>€ <?php echo $result['price']; ?>
  						</td>


  						<td>
  							<ul class="list-inline">
  								<li class="list-inline-item">
  									<a onclick="return confirm('Da li ste sigurni?')"
  										href="?delwlistid=<?php echo $result['productId']; ?>">
  										<button type="button" class="btn btn-danger"><i
  												class="fa fa-trash"></i></button> </a>
  								</li>
  								<ul>
  						</td>


  					</tr>


  					<?php
                        }
                    }   ?>


  				</table>


  			</div>
  			<div class="shopping">
  				<div class="shopleft" style="width: 1050px;">
  					<a href="index.php"><button class="btn btn-warning" type="button">
  							Nastavi kupovinu <span class="glyphicon glyphicon-shopping-cart"></span>
  						</button></a>
  				</div>

  			</div>
  		</div>
  		<div class="clear"></div>

  	</div>
  </div>

  <?php include 'inc/footer.php';
