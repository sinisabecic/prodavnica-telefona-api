<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php include '../../../classes/User.php';  ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dodavanje klijenta
            <small><?php echo $_SESSION['cmrUser'];
            // !* moze i echo Session::get('cmrUser');
            ?></small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">



        <?php
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
        // $is_admin = $_POST['is_admin'];

        if (isset($_POST['is_admin'])) {
            $is_admin = "1";
        } else {
            $is_admin = "0";
        }

        $add_user = $user->admin_add_user($name, $address, $city, $country, $zip, $phone, $email, $username, $password, $is_admin);
    }

?>


        <?php

// !! Alert
if (isset($add_user)) {
    echo $add_user;
}

?>




        <form action="" method="post" enctype="multipart/form-data">


            <!-- Korisnik -->
            <div class="form-group">
                <label for="name">Ime i prezime</label>
                <input type="text" class="form-control" name="name" value="">
            </div>



            <!-- Adresa -->
            <div class="form-group">
                <label for="address">Adresa</label>
                <input type="text" class="form-control" name="address" value="">
            </div>
            <!-- END -->


            <!-- Grad -->
            <div class="form-group">
                <label for="city">Grad</label>
                <input type="text" class="form-control" name="city" value="">
            </div>


            <!-- Zemlja -->
            <div class="form-group">
                <label for="country">Zemlja</label>
                <input type="text" class="form-control" name="country" value="">
            </div>

            <!-- Poštanski broj -->
            <div class="form-group">
                <label for="zip">Poštanski broj</label>
                <input type="text" class="form-control" name="zip" value="">
            </div>

            <!-- Tel broj -->
            <div class="form-group">
                <label for="phone">Tel. broj</label>
                <input type="text" class="form-control" name="phone" value="" placeholder="Primjer: +38269123456">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="">
            </div>

            <div class="form-group">
                <label for="username">Korisničko ime</label>
                <input type="text" class="form-control" name="username" value="">
            </div>

            <div class="form-group">
                <label for="password">Šifra</label>
                <input type="password" class="form-control" name="password" value="">
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php $checked = 'checked'; ?>
                        <input type="checkbox" name="is_admin"
                            value="<?php $checked ? '1' : '0' ?>">
                        Admin
                    </label>
                </div>
            </div>


            <input class="btn btn-success" type="submit" name="submit" value="Sačuvaj">

            <a href="productlist.php"><button type="button" class="btn btn-danger">Odustani</button></a>
        </form>
</div>
</div>
</div>

<!-- Load TinyMCE -->
<?php include 'admin-footer.php';
