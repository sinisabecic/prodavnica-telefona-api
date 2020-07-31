<?php
 $filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 
?>


<?php
 
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db   = new Database();
        $this->fm   = new Format();
    }


    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity =  mysqli_real_escape_string($this->db->link, $quantity);
        $productId =  mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($squery)->fetch_assoc();

        $productName = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];


        $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId ='$sId'";
        $getPro = $this->db->select($chquery);
        if ($getPro) {
            $msg = "<div class='alert alert-warning' role='alert'>Proizvod je vec dodat.</div>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) 
          VALUES ('$sId','$productId','$productName','$price','$quantity','$image')";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                header("Location:cart.php");
            } else {
                header("Location:404.php");
            }
        }
    }


    public function getCartProduct()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId ='$sId' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function updateCartQuantity($cartId, $quantity)
    {
        $cartId =  mysqli_real_escape_string($this->db->link, $cartId);
        $quantity =  mysqli_real_escape_string($this->db->link, $quantity);

        $query = "UPDATE tbl_cart
	            SET
	            quantity = '$quantity'
	            WHERE cartId = '$cartId' ";

        $update_row  = $this->db->update($query);
              
        if ($update_row) {
            header("Location:cart.php");
        } else {
            $msg = "<span class='error'><div class='alert alert-warning' role='alert'>Kolicina proizvoda nije azurirana.</div></span> ";
            return $msg;
        }
    }

    public function delProductByCart($delId)
    {
        $delId =  mysqli_real_escape_string($this->db->link, $delId);
        $query = "DELETE FROM tbl_cart WHERE cartId ='$delId' ";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            echo "<script>window.location = 'cart.php';</script> ";
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Proizvod nije izbrisan iz porudzbine.</div>";
            return $msg;
        }
    }


    public function checkCartTable()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId ='$sId' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function delCustomerCart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId ='$sId'";
        $this->db->delete($query);
    }

    public function orderProduct($cmrId)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId ='$sId' ";
        $getPro = $this->db->select($query);
        if ($getPro) {
            while ($result = $getPro->fetch_assoc()) {
                $productId     = $result['productId'];
                $productName   = $result['productName'];
                $quantity      = $result['quantity'];
                $price         = $result['price'];
                $image         = $result['image'];

                $query = "INSERT INTO tbl_order(cmrId, productId, productName, quantity, price, image) 
          VALUES ('$cmrId','$productId','$productName','$quantity','$price','$image')";

                $inserted_row = $this->db->insert($query);
            }
        }
    }


    public function getOrderProduct($cmrId)
    {
        $query = "SELECT * FROM tbl_order WHERE cmrId ='$cmrId' ORDER BY productId DESC ";
        $result = $this->db->select($query);
        return $result;
    }


    public function getOrdersAlert()
    {
        $query =  "SELECT COUNT(status) as count FROM tbl_order WHERE status = 0 ";
        $result = $this->db->select($query);
        $row = mysqli_fetch_array($result);
        $count_order = $row['count'];
        return $count_order;
    }


    public function getMessagesAlert()
    {
        $query =  "SELECT COUNT(m_id) as poruke FROM tbl_message";
        $result = $this->db->select($query);
        $row = mysqli_fetch_array($result);
        $count_msg = $row['poruke'];
        return $count_msg;
    }




    public function checkOrder($cmrId)
    {
        $query = "SELECT * FROM tbl_order WHERE cmrId ='$cmrId' ";
        $result = $this->db->select($query);
        return $result;
    }



    public function getAllOrderProduct()
    {
        $query = "SELECT * FROM tbl_order o
                  INNER JOIN tbl_users u ON o.cmrId=u.id
                  ORDER BY date ";
        $result = $this->db->select($query);
        return $result;
    }

    public function productShifted($id, $date, $price)
    {
        $id =  mysqli_real_escape_string($this->db->link, $id);
        $date =  mysqli_real_escape_string($this->db->link, $date);
        $price =  mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order
                SET
                status = '1'
                WHERE cmrId = '$id' AND date='$date' AND price='$price'";
        $update_row  = $this->db->update($query);
        if ($update_row) {
            $msg = "<div class='alert alert-success' role='alert'>Isporuceno.</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Greska.</div>";
            return $msg;
        }
    }


    public function delproductShifted($id, $time, $price)
    {
        $id =  mysqli_real_escape_string($this->db->link, $id);
        $date =  mysqli_real_escape_string($this->db->link, $time);
        $price =  mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND date='$date' AND price='$price'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<div class='alert alert-success' role='alert'>Izbrisano.</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Greska.</div>";
            return $msg;
        }
    }
}
