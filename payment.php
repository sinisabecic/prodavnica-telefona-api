    <?php include 'inc/header.php'; ?>
 
 <?php 
  $login =  Session::get("cuslogin");
  if ($login == false) {
  	header("Location:login.php");
  }

  ?>

<style>
.payment{width: 500px;min-height:200px;text-align: center;border: 1px solid #ddd;margin: 0 auto; padding:50px; } 
.payment h2{border-bottom: 2px solid #ddd;margin-bottom: 40px;padding-bottom: 10px;} 
.payment a{
border-radius: 3px;

font-size: 25px;
padding: 5px 30px;} 

.back a{width:150px;margin: 5px auto 0;padding: 7px 0; text-align: center;display: block;font-size: 25px; }


</style>

 <div class="main">
    <div class="content">
      <div class="section group">
      
      <div class="payment"> 
      <h2> izvrši transakciju </h2>  
      <a href="offline.php"><button style="width:150px;" type="button" class="btn btn-success">izvrši <span class="glyphicon glyphicon-ok"></span></button></a>

       <div class="back">
      <a href="cart.php"><button style="width:150px;" type="button" class="btn btn-danger">Nazad <span class="glyphicon glyphicon-arrow-left"></button></span></a>
     
      </div>
      </div>

  


  
    </div>
 </div>
</div>
   
    <?php include 'inc/footer.php'; ?>