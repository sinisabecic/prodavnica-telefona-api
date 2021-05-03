<?php include 'inc/header.php'; ?>

<?php
Session::checkSession();





$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $loginChk = $user->login($username, $password);
}
?>





<div class="container">
	<div class="row">
		<div class="col-6">

			<?php // !*  Ovaj dio je premjesten u futeru da bi radio toast alert
// !*  if(isset($loginChk)){
// !*	echo $loginChk;
// !** }
     
?>


			<div class="jumbotron">
				<p class="h2 purple">Prijava</p>
				<p class="text-muted ">Prijavite se pomoću forme ispod</p>
				<hr>
				<form action=" " method="post">

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text purple bold" id="basic-addon1">Korisničko ime</span>
						</div>
						<input type="text" name="username" class="form-control" aria-label="Username"
							aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Šifra</span>
						</div>
						<input type="password" name="password" class="form-control" aria-label="Password"
							aria-describedby="basic-addon1">
					</div>
					<div class="buttons">
						<div><input class="btn btn-secondary" name="login" type="submit" value="Prijava"></div>
					</div>
				</form>
			</div>
		</div>

		<?php
 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
      $name = $_POST['name'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $country = $_POST['country'];
      $zip = $_POST['zip'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      
      $register = $cmr->user_register($name, $address, $city, $country, $zip, $phone, $email, $username, $password);
  }

?>


		<div class="col-6">


			<?php // ! Alert. Ovo isto sam stavio u futeru kako bi toast alert radio
        //? if (isset($register)) {
        // ?    echo  $register;
        // ? }
?>
			<div class="jumbotron">
				<p class="h2 purple">Registracija</p>
				<p class="text-muted ">Registrujte se pomoću forme ispod</p>
				<hr>
				<form action=" " method="post">

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Ime i prezime</span>
						</div>
						<input name="name" placeholder="" type="text" aria-label="First name"
							class="form-control arial">
					</div>


					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">E-mail</span>
						</div>
						<input name="email" type="email" class="form-control arial" aria-label="Username"
							aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Korisničko ime</span>
						</div>
						<input name="username" type="text" class="form-control arial" aria-label="Username"
							aria-describedby="basic-addon1">
					</div>


					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Šifra</span>
						</div>
						<input name="password" type="password" class="form-control arial" aria-label="Username"
							aria-describedby="basic-addon1">
					</div>


					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Grad</span>
						</div>
						<input type="text" name="city" class="form-control arial" aria-label="Username"
							aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Adresa</span>
						</div>
						<input name="address" type="text" class="form-control arial" aria-label="Username"
							aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Poštanski broj</span>
						</div>
						<input name="zip" type="text" class="form-control arial" aria-label="Username"
							aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect01">Zemlja</label>
						</div>
						<select name="country" class="custom-select arial" id="inputGroupSelect01">
							<?php
                  foreach ($countries as $key => $value) {
                      ?>
							<option value="<?= $key ?>"
								title="<?= htmlspecialchars($value) ?>">
								<?= htmlspecialchars($value) ?>
							</option>
							<?php
                  } ?>
						</select>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Telefon</span>
						</div>
						<input name="phone" type="text" class="form-control arial" aria-label="Username"
							aria-describedby="basic-addon1" placeholder="+382 69 123 456">
					</div>


					<input class="btn btn-secondary" name="register" type="submit" value="Kreiraj nalog" />
					<p class="terms">Klikom na dugme 'Kreiraj nalog' prihvatate <a href="#">Uslove koriscenja
						</a>.</p>

				</form>
			</div><!-- end jumbotron -->
		</div>

	</div><!-- end row -->
</div><!-- end container -->


<?php include 'inc/footer.php';
