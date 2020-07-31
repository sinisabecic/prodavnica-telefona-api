  <?php include 'inc/header.php'; ?>


  <div class="container">
  	<div class="main">
  		<!-- <div class="content"> -->
  		<div class="jumbotron">
  			<div class="row">
  				<div class="col-8">
  					<p class="h2 purple">Live Support</p>
  					<div class="support_desc">
  						<p><span>24 časa | 7 dana u nedelji | 365 dana u godini &nbsp;&nbsp; Tehnička podrška</span>
  						</p>
  						<p> Davno je ustanovljena činjenica da će čitaoc biti omamljen čitljivim sadržajem stranice
  							kada
  							gleda
  							njegov izgled. Smisao upotrebe Lorema Ipsuma je da ima više ili manje normalne
  							distribucije
  							slova.
  							Postoje mnoge varijacije odlomaka Lorem Ipsum-a, ali većina ih je pretrpjela promjenu u
  							nekoj
  							formi, ubrizganim humorom ili nasumičnim riječima ne izgledaju čak ni malo uvjerljivi. Ako
  							ćete
  							koristiti odlomak Lorem Ipsum, morate biti sigurni da se ništa neugodno ne nađe u sredini
  							teksta.
  						</p>
  					</div>

  					<div class="clear"></div>
  				</div>
  			</div>
  			<hr>
  			<div class="row">
  				<div class="col-8">
  					<h2 class="purple">Kontaktirajte nas</h2>
  					<hr>


  					<!-- Alert -->
  					<?php
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $message = $con->sendMessage($_POST); // ovo con je iz inc/header con = new Contact();
    }

    if (isset($message)) {
        echo $message;
    }

?>

  					<form action=" " method="post">
  						<div class="input-group mb-3">
  							<div class="input-group-prepend">
  								<span class="input-group-text">Ime i prezime</span>
  							</div>
  							<input name="name" placeholder="" type="text" aria-label="First name"
  								class="form-control arial">
  							<div class="input-group-prepend">
  								<span class="input-group-text" id="basic-addon1">E-mail</span>
  							</div>
  							<input name="email" type="email" class="form-control arial" aria-label="Username"
  								aria-describedby="basic-addon1">
  						</div>
  						<div class="input-group mb-3">
  							<div class="input-group-prepend">
  								<span class="input-group-text" id="basic-addon1">Telefon</span>
  							</div>
  							<input name="phone" type="text" class="form-control arial" aria-label="Username"
  								aria-describedby="basic-addon1" placeholder="+382 69 123 456">
  						</div>

  						<div class="input-group mb-3">
  							<div class="input-group-prepend">
  								<span class="input-group-text" id="basic-addon1">Poruka</span>
  							</div>
  							<textarea name="message" type="text" class="form-control arial" aria-label="Username"
  								aria-describedby="basic-addon1 bg-purple bijela" placeholder=""></textarea>
  						</div>
  						<button name="submit" type="submit" class="btn btn-success">Pošalji</button>

  					</form>
  				</div>

  				<div class="col-4">
  					<div class="company_address">
  						<h2>Informacije o firmi :</h2>
  						<hr>
  						<p>500 Lorem Ipsum Dolor Sit,</p>
  						<p>22-56-2-9 Sit Amet, Lorem,</p>
  						<p>MNE</p>
  						<p>Tel:(00) 222 666 444</p>
  						<p>Fax: (000) 000 00 00 0</p>
  						<p>Mejl: <span>nenad.aranitovic@gmail.com</span></p>
  						<p>Prati nas: <span>Facebook</span>, <span>Twitter</span></p>
  					</div>
  				</div>
  			</div>
  		</div>
  		<!-- </div> -->
  	</div>
  </div>
  </div>
  <?php include 'inc/footer.php';
