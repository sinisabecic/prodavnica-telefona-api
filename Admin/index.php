<!-- Header -->
<?php include 'admin-header.php'; ?>
<!-- Admin navigacija -->
<?php include 'admin-navigation.php'; ?>
<!-- Lijevi sajdbar -->
<?php include 'left-sidebar.php'; ?>

<?php
include '../classes/UserAdvance.php'; // ! Napravio sam ovaj model koji posjeduje dodatne funkcije
include '../classes/Product.php';

$user = new User();
$product = new Product();
$brand = new Category(); // ! Ovo su zapravo proizvodjaci(brendovi)

?>

<!-- Tabela Posts -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Komandna tabla
            <small><?php echo $_SESSION['cmrUser'];
            // !* moze i echo Session::get('cmrUser');
            ?></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- <div class="box">
                    <div class="box-body"> -->

                <?php
$query = "SELECT * FROM tbl_order where status=0";
$select_query = mysqli_query($conn, $query);
$porudzbine_count = mysqli_num_rows($select_query); // broj kolona u tabeli posts

?>

                <!-- WIDGETS -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-plava">
                            <div class="inner">
                                <h3 class="bijela"><?php echo $porudzbine_count; ?>
                                </h3>

                                <p class="bijela">Nove porudžbine</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="/admin/pages/tables/mainorder.php" class="small-box-footer bijela">Više
                                informacija <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green2">
                            <div class="inner">
                                <h3 class="bijela"><?php echo $product->count(); ?>
                                </h3>

                                <p class="bijela">Proizvodi</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-iphone"></i>
                            </div>
                            <a href="/admin/pages/tables/productlist.php" class="small-box-footer">Više
                                informacija <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-orange2">
                            <div class="inner">
                                <h3 class="bijela"><?php echo $user->count(); ?>
                                </h3>

                                <p class="bijela">Korisnici</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/admin/pages/tables/users.php" class="small-box-footer">Više informacija <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red2">
                            <div class="inner">
                                <h3 class="bijela"><?php echo $brand->count() ?>
                                </h3>

                                <p class="bijela">Proizvođači</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/admin/pages/tables/catlist.php" class="small-box-footer">Više informacija
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row  end WIDGETS-->

                <?php

//  ! Ovaj dio sam radio zbog statisticke pogace
$query = "SELECT * FROM tbl_product"; // aktivni postovi
$select_query = mysqli_query($conn, $query);
$Telefoni_i_oprema_count = mysqli_num_rows($select_query); // broj kolona u tabeli posts


$query = "SELECT * FROM tbl_order";
$select_query = mysqli_query($conn, $query);
$porudzbine_count = mysqli_num_rows($select_query);


$query = "SELECT * FROM tbl_users";
$select_query = mysqli_query($conn, $query);
$users_count = mysqli_num_rows($select_query);


$desc = array();
$query = "SELECT * FROM tbl_category";
$select_query = mysqli_query($conn, $query);
$Proizvodjaci_count = mysqli_num_rows($select_query);

?>


                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load("current", {
                        packages: ["corechart"]
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Chart', 'Count'],
                            <?php
                                    $element_text = ['Telefoni i oprema', 'Porudzbine', 'Proizvodjaci', 'Korisnici'];//naslovi kategorija
                                    $element_count = [ $Telefoni_i_oprema_count, $porudzbine_count, $Proizvodjaci_count, $users_count ]; //vrijednosti kategorija

                                    for ($i = 0; $i < 4; $i++) {
                                        echo "['$element_text[$i]'" . "," . "$element_count[$i]],";
                                    }
                                ?>

                        ]);

                        var options = {
                            title: '',
                            pieHole: 0.4,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById(
                            'donutchart'));
                        chart.draw(data, options);
                    }
                </script>

                <?php // ! Ovo sam uklonio trenutno?>
                <!-- <div id="donutchart"></div> -->




            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->






</div>
<!-- /.content-wrapper -->




<!-- FOOTER -->
<?php include 'admin-footer.php';
