<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php include '../../../classes/User.php';  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            Izmjena informacija o korisniku
            <small><?php echo $_SESSION['cmrUser'];
            // !* moze i echo Session::get('cmrUser');
            ?></small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">


        <?php

 if (!isset($_GET['user'])  || $_GET['user'] == null) {
     echo "<script>window.location = 'users.php';  </script>";
 } else {
     $user_id = $_GET['user'];
 }

   $user =  new User();

   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
       $name = $_POST['name'];
       $address = $_POST['address'];
       $city = $_POST['city'];
       $country = $_POST['country'];
       $zip = $_POST['zip'];
       $phone = $_POST['phone'];
       $email = $_POST['email'];
       $username = $_POST['username'];
       $password = $_POST['password'];

       // Za Admin checkbox
       if (isset($_POST['is_admin'])) {
           $admin = "1";
       } else {
           $admin = "0";
       }
       $updateUser = $user->update($user_id, $name, $address, $city, $country, $zip, $phone, $email, $username, $password, $admin);
   }


   // !* Ovaj dio ce da ide u admin-footer ispot toast script
if (isset($updateUser)) {
    echo $updateUser;
}


     $getUsers = $user->getUserData($user_id);
     if ($getUsers) {
         while ($value = $getUsers->fetch_assoc()) {
             $password = $value['password'];
             $decrypted_password =  base64_decode($password); ?>

        <form action="" method="post" enctype="multipart/form-data">

            <!-- ID -->
            <div id="mongodbID" class="form-group">
                <label for="id">ID (MongoDB)</label>
                <input type="text" class="form-control"
                    value="<?php echo $value['id']; ?>"
                    disabled>
            </div>

            <!-- Korisnik -->
            <div class="form-group">
                <label for="name">Ime i prezime</label>
                <input type="text" class="form-control" name="name"
                    value="<?php echo $value['name']; ?>">
            </div>



            <!-- Adresa -->
            <div class="form-group">
                <label for="address">Adresa</label>
                <input type="text" class="form-control" name="address"
                    value="<?php echo $value['address']; ?>">
            </div>
            <!-- END -->


            <!-- Grad -->
            <div class="form-group">
                <label for="city">Grad</label>
                <input type="text" class="form-control" name="city"
                    value="<?php echo $value['city']; ?>">
            </div>


            <!-- Zemlja -->
            <div class="form-group">
                <label for="country">Zemlja</label>
                <input type="text" class="form-control" name="country"
                    value="<?php echo $value['country']; ?>">
            </div>

            <!-- Poštanski broj -->
            <div class="form-group">
                <label for="zip">Poštanski broj</label>
                <input type="text" class="form-control" name="zip"
                    value="<?php echo $value['zip']; ?>">
            </div>

            <!-- Tel broj -->
            <div class="form-group">
                <label for="phone">Tel. broj</label>
                <input type="text" class="form-control" name="phone"
                    value="<?php echo $value['phone']; ?>">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email"
                    value="<?php echo $value['email']; ?>">
            </div>

            <!-- Korisnik -->
            <div class="form-group">
                <label for="name">Korisničko ime</label>
                <input type="text" class="form-control" name="username"
                    value="<?php echo $value['username']; ?>">
            </div>

            <div class="form-group">
                <label for="pass">Šifra</label>
                <input type="password" class="form-control" name="password"
                    value="<?php echo $decrypted_password; ?>">
            </div>


            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_admin" <?php echo($value['is_admin'] == 1 ? 'checked' : ''); ?>>
                        Admin
                    </label>
                </div>
            </div>


            <input class="btn btn-success" type="submit" name="submit" value="Sačuvaj">

            <a href="users.php"><button type="button" class="btn btn-danger">Odustani</button></a>
        </form>

        <?php
         }
     } ?>

</div>
</div>
</div>



<?php include 'admin-footer.php';
