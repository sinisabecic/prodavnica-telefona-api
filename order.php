 <?php include 'inc/header.php'; ?>

 <?php
  $login =  Session::get("cuslogin");
  if ($login == false) {
      header("Location:login.php");
  }

  ?>
 <style>
   #tblone td {
     text-align: center;
   }

   #tblone tr th {
     text-align: center;
     font-weight: bold;
   }
 </style>
 <div class="container">
   <div class="main">


     <div class="section group">
       <div class="notfound">
         <p class="h2 purple"> Vaši detalji porudžbine</p>
         <hr>

         <table class="table table-borderless table-hover" id="tblone">
           <thead class="bg-purple bijela">
             <tr>
               <th>Id</th>
               <th>Proizvod</th>
               <th>Slika</th>
               <th>Količina</th>
               <th>Ukupna cijena</th>
               <th>Datum</th>
               <th>Status</th>
               <!-- <th>Akcija</th> -->
             </tr>
           </thead>

           <?php
           $cmrId =  Session::get("cmrId");
          $getOrder = $ct->getOrderProduct($cmrId);
          if ($getOrder) {
              $i = 0;
            
              while ($result = $getOrder->fetch_assoc()) {
                  $i++; ?>
           <tr>
             <td><?php echo $i; ?>
             </td>
             <td><a
                 href="preview.php?proid=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?>
             </td>
             <td><img
                 src="admin/pages/tables/<?php echo $result['image']; ?>"
                 height="100px;" width="80px;" alt="" /></td>
             <td> <?php echo $result['quantity']; ?>
             </td>

             <td>€
               <?php
                  $total = $result['price'] * $result['quantity'];
                  echo $total; ?>

             </td>

             <td><?php echo  $fm->formatDate($result['date']); ?>
             </td>

             <td>

               <?php
                  if ($result['status'] == '0') { ?>
               <span class="badge badge-warning">Na cekanju</span>
               <?php   } else { ?>
               <span class="badge badge-success">Primljeno</span>
               <?php   } ?>

             </td>

             <?php /*
                if ($result['status'] == '1') { ?>
                 <td><a onclick="return confirm('Da li ste sigurni?');" href=" ">X</a></td>
               <?php }else {  ?>
                <td>Nema odgovora </td>

              <?php  } */ ?>


           </tr>



           <?php
              }
          }   ?>


         </table>



       </div>

     </div>




     <div class="clear"></div>
   </div>

 </div>

 <?php include 'inc/footer.php';
