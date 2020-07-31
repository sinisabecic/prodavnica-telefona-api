    <?php include 'inc/header.php'; ?>

    <?php
  $login =  Session::get("cuslogin");
  if ($login == false) {
      header("Location:login.php");
  }

  ?>

    <?php

    $cmrId =  Session::get("cmrId");

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
        
        if (Session::get("is_admin") == "1") {
            $is_admin = "1";
        } else {
            $is_admin = "0";
        }
        
        $updateCmr = $cmr->userUpdate($cmrId, $name, $address, $city, $country, $zip, $phone, $email, $username, $password, $is_admin);
    }
?>


    <style>
      #tblone {
        width: 550px;
        margin: 0 auto;
      }

      #tblone input[type="text"] {
        width: 400px;
        padding: 5px;
        font-size: 15px;
      }
    </style>

    <div class="main">
      <div class="content">
        <div class="section group">

          <?php

   $getdata = $cmr->getUserData($cmrId);
   if ($getdata) {
       while ($result = $getdata->fetch_assoc()) {
           $password = $result['password'];
           $decrypted_password =  base64_decode($password); ?>

          <form action=" " method="post" id="tblone">

            <?php
    if (isset($updateCmr)) {
        echo "<tr> <td colspan='2'>".$updateCmr."</td> </tr>";
    } ?>

            <div class="form-group">
              <label>Korisničko ime</label>
              <input name="username" type="text" class="form-control"
                value="<?php echo $result['username']; ?>">
            </div>

            <div class="form-group">
              <label>Lozinka <small class="alert-danger">(Lozinka je enkriptovana)</small></label>
              <input name="password" type="text" class="form-control"
                value="<?php echo $decrypted_password; ?>">
            </div>

            <div class="form-group">
              <label>Ime i prezime</label>
              <input name="name" type="text" class="form-control"
                value="<?php echo $result['name']; ?>">
            </div>

            <div class="form-group">
              <label>Telefon</label>
              <input name="phone" type="text" class="form-control" id="formGroupExampleInput"
                value="<?php echo $result['phone']; ?>">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Mejl</label>
              <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?php echo $result['email']; ?>">
            </div>

            <div class="form-group">
              <label>Adresa</label>
              <input name="address" type="text" class="form-control" id="formGroupExampleInput"
                value="<?php echo $result['address']; ?>">
            </div>

            <div class="form-group">
              <label>Grad</label>
              <input name="city" type="text" class="form-control" id="formGroupExampleInput"
                value="<?php echo $result['city']; ?>">
            </div>

            <div class="form-group">
              <label>Postanski broj</label>
              <input name="zip" type="text" class="form-control" id="formGroupExampleInput"
                value="<?php echo $result['zip']; ?>">
            </div>

            <div class="form-group">
              <label>Zemlja</label>
              <input name="country" type="text" class="form-control" id="formGroupExampleInput"
                value="<?php echo $result['country']; ?>">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">sačuvaj</button>
            <a href="profile.php"><button type="button" class="btn btn-danger">Odustani</button></a>

            <?php
            $getData = $ct->checkCartTable();
           if ($getData) {
               ?>
            <a href="offline.php"><button type="button" class="btn btn-warning">Nastavi sa poručivanjem</button></a>
            <?php
           } ?>

            </table>
          </form>

          <?php
       }
   }  ?>

        </div>
      </div>
    </div>

    <?php include 'inc/footer.php';
