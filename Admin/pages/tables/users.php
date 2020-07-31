<?php
      include 'admin-header.php';
      include 'admin-navigation.php';
      include 'left-sidebar.php';
      include '../../../classes/User.php';
      require_once '../../../helpers/Format.php';
?>

<?php
$user = new User();
$fm = new Format();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Korisnici
            <small><?php echo Session::get('cmrUser');
            // !* moze i echo $_SESSION['cmrUser'];
            ?></small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ime</th>
                                    <th>Korisnik</th>
                                    <th>Email</th>
                                    <th>Šifra</th>
                                    <th>Telefon</th>
                                    <th>Lokacija</th>
                                    <th class="text-center">Tip</th>
                                    <th class="text-center">Akcija</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
           $getUsers = $user->getUsers();
               while ($result = $getUsers->fetch_assoc()) {
                   ?>
                                <tr>
                                    <td>
                                        <p class="green">
                                            <?php echo $fm->textShorten($result['id'], 5); ?>
                                        </p>
                                    </td>
                                    <td><?php echo $result['name']; ?></a>
                                    </td>
                                    <td><strong class="purple">
                                            <?php echo $result['username']; ?>
                                        </strong>
                                    </td>
                                    <td><a
                                            href="mailto:<?php echo $result['email']; ?>">
                                            <?php echo $result['email']; ?></a>
                                    </td>
                                    <td><?php echo $fm->textShorten($result['password'], 5); ?>
                                    </td>
                                    <td><a
                                            href="tel:<?php echo $result['phone']; ?>">
                                            <?php echo $result['phone']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $fm->textShorten($result['city'].' '
                                              .$result['zip']. ', '
                                              .$result['address']. ', '
                                              .$result['country'], 20); ?>
                                    </td>

                                    <td class="text-center"><?php
                                        if ($result['is_admin'] == 1) {
                                            echo '<span class="label label-primary">Admin</span>';
                                        } else {
                                            echo '<span class="label label-default">Klijent</span>';
                                        } ?>
                                    </td>
                                    <td style="text-align: center;"><a
                                            href="useredit.php?user=<?php echo $result['id']; ?>"><button
                                                type="button" class="btn btn-primary"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i></button></a>

                                        <button
                                            onclick="delUser('<?php echo $result['id']; ?>')"
                                            type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
               }
           ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?php include 'admin-footer.php';
