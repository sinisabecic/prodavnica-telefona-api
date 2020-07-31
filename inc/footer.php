<div class="footer">
	<div class="container-md">
		<div class="section group">
			<div class="col_1_of_4 span_1_of_4">
				<h4>Informacije</h4>
				<ul>
					<li><a href="#">O nama</a></li>
					<li><a href="#">Korisnički servis</a></li>
					<li><a href="#"><span>Napredna pretraga</span></a></li>
					<li><a href="#">Narudžbe i povraćaj</a></li>
					<li><a href="#"><span>Kontakt</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Zašto kupovati kod nas?</h4>
				<ul>
					<li><a href="#">O nama</a></li>
					<li><a href="#">Korisnički servis</a></li>
					<li><a href="#"><span>Mapa sajta</span></a></li>
					<li><a href="#"><span>Termini za pretragu</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Moj nalog</h4>
				<ul>
					<li><a href="/login.php">Prijava</a></li>
					<li><a href="/cart.php">Vidi korpu</a></li>
					<li><a href="/wishlist.php">Moja lista želja</a></li>
					<li><a href="/order.php">Prati moju narudžbu</a></li>
					<li><a href="#">Pomoć</a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Kontakt</h4>
				<ul>
					<li><span class="zelena">nenad.aranitovic@gmail.com</span></li>
				</ul>
				<div class="social-icons">
					<h4>Prati nas</h4>
					<ul>

						<?php
                            $brand =  new Brand();
                            $getsocial = $brand->getsocialById();
                            if ($getsocial) {
                                while ($result = $getsocial->fetch_assoc()) {
                                    ?>
						<li class="facebook"><a
								href="<?php echo $result['fb'] ?>"
								target="_blank"> </a></li>
						<li class="twitter"><a
								href="<?php echo $result['tw'] ?>"
								target="_blank"> </a></li>
						<li class="googleplus"><a
								href="<?php echo $result['ln'] ?>"
								target="_blank"> </a></li>
						<li class="contact"><a
								href="<?php echo $result['gp'] ?>"
								target="_blank"> </a></li>

						<?php
                                }
                            }  ?>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
		</div>
		<div class="copy_right">
			<a href="opis-projekta.html" target="__blank">
				<p class="bijela">Nenad Aranitović - Internet tehnologije</p>
			</a>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/

		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
	$(function() {
		SyntaxHighlighter.all();
	});
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			start: function(slider) {
				$('body').removeClass('loading');
			}
		});
	});
</script>






<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
	integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
	integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


<script type="text/javascript" src="js/jquery.toast.js"></script>


<?php
      if (isset($loginChk)) {
          echo $loginChk;
      }
?>

<?php
        if (isset($register)) {
            echo $register;
        }
?>

<?php // !* Azuriranje podataka korisnika od strane korisnika
    if (isset($updateCmr)) {
        echo $updateCmr;
    }
?>

<!-- Za brisanje proizvoda iz korpe -->
<script>
	function delItem(item) {
		if (confirm('Da li ste sigurni?')) {
			var formData = {
				'product_id': item
			};
			$.ajax({
				type: 'POST',
				url: 'functions/delete-product.php',
				data: formData,
				success: function(response) {
					if (response.error) {
						console.log(response.error);
						alert(response.error);
					} else {
						console.log(response.success);
						window.location.reload(true);
					}
				},
				error: function(error) {
					console.log(error);
					alert("Greška, učitajte ponovo");
				},
				async: false
			});
		}
	}
</script>



</body>

</html>