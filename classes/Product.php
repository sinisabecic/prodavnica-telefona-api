<?php
 $filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 
?>

<?php
 
class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db   = new Database();
        $this->fm   = new Format();
    }

    public function productInsert($data, $file)
    {
        $productName =  mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId 			=  mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId 		=  mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body 			=  mysqli_real_escape_string($this->db->link, $data['body']);
        $price  		=  mysqli_real_escape_string($this->db->link, $data['price']);
        $type 			=  mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg','png','jpeg','gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;
        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<div class='alert alert-warning' role='alert'>Popuni sva polja.</div>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) 
          VALUES ('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";

            $inserted_row = $this->db->insert($query);

            if ($inserted_row) {
                $msg = "<div class='alert alert-success' role='alert'>Dodato. <a href='productlist.php' class='alert-link'> Vrati se</a>.</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger' role='alert'>
  Greska. <a href='productlist.php' class='alert-link'> Vrati se</a>.</div> ";
                return $msg;
            }
        }
    }



    public function getAllProduct()
    {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
         FROM tbl_product
         INNER JOIN tbl_category
         ON tbl_product.catId = tbl_category.catId
         INNER JOIN tbl_brand
         ON tbl_product.brandId = tbl_brand.brandId
         ORDER BY tbl_product.productId DESC";
        $result =  $this->db->select($query);
        return $result;
    }
  
    public function getAllProductImageSlider()
    {
        $query = "SELECT *
         FROM tbl_product         
         ORDER BY productId DESC LIMIT 5";
        $result =  $this->db->select($query);
        return $result;
    }
  
  
  



    public function getProById($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='$id' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function productUpdate($data, $file, $id)
    {
        $productName    =  mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId 			=  mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId 		=  mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body 			=  mysqli_real_escape_string($this->db->link, $data['body']);
        $price  		=  mysqli_real_escape_string($this->db->link, $data['price']);
        $type 			=  mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg','png','jpeg','gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;
        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<div class='alert alert-warning' role='alert'>Popuni sva polja.</div> ";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 10054589) {
                    echo "<div class='alert alert-warning' role='alert'>Maksimalna velicina slike je 10MB</div>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<div class='alert alert-warning' role='alert'>Mozes uploadovati samo ".implode(',', $permited)."</div>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product
          SET 
          productName 	= '$productName',
          catId 		= '$catId',
          brandId 		= '$brandId',
          body 			= '$body',
          price 		= '$price',
          image 		= '$uploaded_image',
          type 			= '$type'
          WHERE productId = '$id' ";


                    $updated_row = $this->db->update($query);
                    if ($updated_row) {
                        $msg = "<div class='alert alert-success' role='alert'>Izmijenjeno. <a href='productlist.php' class='alert-link'>  Vrati se</a>.</div> ";
                        return $msg;
                    } else {
                        $msg = "<div class='alert alert-danger' role='alert'>Greska. <a href='productlist.php' class='alert-link'> Vrati se.</a>.</div> ";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE tbl_product
          SET 
          productName 	= '$productName',
          catId 		= '$catId',
          brandId 		= '$brandId',
          body 			= '$body',
          price 		= '$price',
          
          type 			= '$type'
          WHERE productId = '$id' ";


                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $msg = "<div class='alert alert-success' role='alert'>Izmijenjeno. <a href='productlist.php' class='alert-link'> Vrati se</a>.</div> ";
                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger' role='alert'>Greska. <a href='productlist.php' class='alert-link'> Vrati se.</a>.</div> ";
                    return $msg;
                }
            }
        }
    }



    public function delPorById($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $getData = $this->db->select($query);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $dellink = $delImg['image'];
                unlink($dellink);
            }
        }

        $delquery = "DELETE FROM tbl_product WHERE productId = '$id' ";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = "<div class='alert alert-success' role='alert'>Izbrisano.</div> ";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Neuspjesno brisanje.</div> ";
            return $msg;
        }
    }



    public function getFeaturedProduct()
    {
        $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 6 ";
        $result = $this->db->select($query);
        return $result;
    }


    public function getNewProduct()
    {
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4 ";
        $result = $this->db->select($query);
        return $result;
    }


    public function getSingleProduct($id)
    {
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
         FROM tbl_product
         INNER JOIN tbl_category
         ON tbl_product.catId = tbl_category.catId
         INNER JOIN tbl_brand
         ON tbl_product.brandId = tbl_brand.brandId
         AND tbl_product.productId = $id
         ORDER BY tbl_product.productId DESC";
        $result =  $this->db->select($query);
        return $result;
    }

    public function latestFrom1()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='1' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }


    public function latestFrom2()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='2' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }



    public function latestFrom3()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='3' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }



    public function latestFrom4()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='4' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }

 
 
    public function latestFrom5()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='5' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }

 
    public function latestFrom6()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='6' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
 
    public function latestFrom7()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='7' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
 
    public function latestFrom8()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='8' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
 
    public function latestFrom9()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='9' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
 
    public function latestFrom10()
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='10' ORDER BY productId DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
 
  
 

    public function productByCat($id)
    {
        $catId  =  mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM tbl_product WHERE catId ='$catId' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function productByOnlyCat($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId ='$id' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function inserCompareDate($productId, $cmrId)
    {
        $cmrId       =  mysqli_real_escape_string($this->db->link, $cmrId);
        $productId   =  mysqli_real_escape_string($this->db->link, $productId);

        $cquery = "SELECT * FROM tbl_compare WHERE cmrId ='$cmrId' AND productId ='$productId' ";
        $check = $this->db->select($cquery);
        if ($check) {
            $msg = "<span class='error'>Proizvod je vec dodat.</span> ";
            return $msg;
        }


        $query = "SELECT * FROM tbl_product WHERE productId ='$productId' ";
        $result = $this->db->select($query)->fetch_assoc();
        if ($result) {
            $productId     = $result['productId'];
            $productName   = $result['productName'];
     
            $price         = $result['price'];
            $image         = $result['image'];

            $query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) 
          VALUES ('$cmrId','$productId','$productName','$price','$image')";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Added To Compare.</span> ";
                return $msg;
            } else {
                $msg = "<span class='error'>Not Added.</span> ";
                return $msg;
            }
        }
    }


    public function getCompareProduct($cmrId)
    {
        $query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }


    public function delCompareData($cmrId)
    {
        $query = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId' ";
        $deldata = $this->db->delete($query);
    }


    public function saveWishListData($id, $cmrId)
    {
        $cquery = "SELECT * FROM tbl_wlist WHERE cmrId ='$cmrId' AND productId ='$id' ";
        $check = $this->db->select($cquery);
        if ($check) {
            $msg = "<div class='alert alert-warning' role='alert'>Proizvod je vec dodat.</div>";
            return $msg;
        }


        $pquery = "SELECT * FROM tbl_product WHERE productId ='$id' ";
        $result = $this->db->select($pquery)->fetch_assoc();
        if ($result) {
            $productId     = $result['productId'];
            $productName   = $result['productName'];
     
            $price         = $result['price'];
            $image         = $result['image'];

            $query = "INSERT INTO tbl_wlist(cmrId, productId, productName, price, image) 
          VALUES ('$cmrId','$productId','$productName','$price','$image')";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<div class='alert alert-success' role='alert'>Dodato na listi zelja.<a href='wishlist.php' class='alert-link'> Lista zelja</a>.</div>  ";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger' role='alert'>Greska.</div>  ";
                return $msg;
            }
        }
    }

    public function checkWlistData($cmrId)
    {
        $query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }


    public function delWlistData($cmrId, $productId)
    {
        $query = "DELETE FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId' ";
        $deldata = $this->db->delete($query);
    }


    public function productBySearch($search)
    {
        $query = "SELECT DISTINCT *
                  FROM tbl_product p
        inner join tbl_brand b  on p.brandId=b.brandId 
        inner join tbl_category c on c.catId=p.catId
        
        where (
                p.productName LIKE '%$search%' 
                OR p.body LIKE '%$search%' 
                OR p.price LIKE '%$search%' 
                OR b.brandName LIKE '%$search%'
                OR c.catName LIKE '%$search%'
            )";
        

        $result = $this->db->select($query);
        return $result;
    }


    public function count()
    {
        $query = "SELECT * FROM tbl_product";
        $select = $this->db->select($query);
        $result = mysqli_num_rows($select);
        return $result;
    }
}
