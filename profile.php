    <?php include 'inc/header.php'; ?>

    <?php
  $login =  Session::get("cuslogin");
  if ($login == false) {
      header("Location:login.php");
  }

  ?>

    <style>
      #tblone {
        width: 550px;
        margin: 0 auto;
      }

      #tblone tr td {
        text-align: justify;
      }

      th {
        width: 5%;
        font-weight: bold;
      }
    </style>

    <div class="main">
      <div class="content">
        <div class="section group">

          <?php
   $id = Session::get('cmrId');
   $getdata = $cmr->getUserData($id);
   if ($getdata) {
       while ($result = $getdata->fetch_assoc()) {
           ?>


          <table class="table table-sm table-light font-weight-light" id="tblone">

            <tr>

              <td colspan="3">
                <h2> Profilni podaci </h2>
              </td>

            </tr>

            <tbody>
              <tr>
                <br>
                <th scope="row">Ime i Prezime :</th>
                <td><?php echo $result['name']; ?>
                </td>
              </tr>

              <tr>
                <th scope="row">Telefon :</th>
                <td><?php echo $result['phone']; ?>
                </td>
              </tr>
              <tr>
                <th scope="row">Mejl :</th>
                <td colspan="2"><?php echo $result['email']; ?>
                </td>

              </tr>
              <tr>
                <th scope="row">Adresa :</th>
                <td colspan="2"><?php echo $result['address']; ?>
                </td>

              </tr>
              <tr>
                <th scope="row">Grad :</th>
                <td colspan="2"><?php echo $result['city']; ?>
                </td>

              </tr>
              <tr>
                <th scope="row">Poštanski broj :</th>
                <td colspan="2"><?php echo $result['zip']; ?>
                </td>
              </tr>
              <tr>
                <th scope="row">Zemlja :</th>
                <td colspan="2"><?php echo $result['country']; ?>
                </td>
              </tr>

            </tbody>
            <tr>
              <td><a href="editprofile.php"><button style="width:300px;" type="button"
                    class="btn btn-outline-success"><i class="fa fa-pencil" aria-hidden="true"></i></button> </a> </td>
            </tr>


          </table>
          <br>


          <?php
       }
   }  ?>

        </div>
      </div>
    </div>

    <?php include 'inc/footer.php';
