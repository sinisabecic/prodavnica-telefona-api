<?php include 'admin-header.php';?>
<?php include 'admin-navigation.php';?>
<?php include 'left-sidebar.php'; ?>
<?php include_once '../../../helpers/Format.php';?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Prijemno sanduče
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


          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-bordered table-hover">

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Sadržaj poruke</th>
                  <th>Posiljalac</th>
                  <th>Telefon</th>
                  <th>Mejl</th>
                  <th>Datum</th>
                  <th>Brisanje</th>
                  <th>Označi kao pročitano</th>
                </tr>
              </thead>
              <tbody>

                <?php
           $getM = $msg->getAllMessages();
           if ($getM) {
               $i = 0;
               while ($result = $getM->fetch_assoc()) {
                   $i++;
                   $status = $result['status'];
                   
                   if ($status == 0) { ?>
                <tr class="bg-danger">
                  <?php } ?>

                  <td width="5%"><?php
                  if (isset($result['m_id'])) {
                      echo $result['m_id'];
                  } ?>
                  </td>
                  <td width="60%"><?php
                    if (isset($result['message'])) {
                        echo $fm->textShorten($result['message'], 999);
                    } ?>
                  </td>
                  <td width="10%"><?php if (isset($result['name'])) {
                        echo $result['name'];
                    } ?>
                  </td>
                  <td width="5%">
                    <a
                      href="tel:<?php echo $result['phone']; ?>">
                      <?php
                  if (isset($result['phone'])) {
                      echo $result['phone'];
                  } ?>
                    </a>
                  </td>
                  <td width="5%">
                    <a
                      href="mailto:<?php echo $result['email']; ?>"><?php
                  if (isset($result['email'])) {
                      echo $result['email'];
                  } ?>
                    </a>
                  </td>
                  <td width="15%"><?php
                  if (isset($result['date'])) {
                      echo $result['date'];
                  } ?>
                  </td>
                  <td><button
                      onclick="delMessage('<?php echo $result['m_id']; ?>')"
                      type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>

                  <td>
                    <?php if ($status == 0) { ?>
                    <button
                      onclick="setAsSeen('<?php echo $result['m_id']; ?>')"
                      type="button" class="btn btn-success"><i class="fa fa-check"></i></button>
                    <?php } ?>
                  </td>

                </tr>
                <?php
               }
           } ?>


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
