<?php
 $filepath = realpath(dirname(__FILE__));
 include_once($filepath.'/../lib/Session.php');
 Session::checkSession();
 
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
  


class Admin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db   = new Database();
        $this->fm   = new Format();
    }
    
    // ! Nije kompletna funkcija za pretragu na admin strani
    public function search($search)
    {
        $query = "SELECT DISTINCT * FROM tbl_product p, tbl_brand b, tbl_users u, tbl_order o
        WHERE p.productId=b.brandId and o.o_id=u.id 
        (productName LIKE '%$search%' 
        OR body LIKE '%$search%' 
        or price LIKE '%$search%' 
        OR brandName LIKE '%$search%') ";

        $result = $this->db->select($query);
        return $result;
    }
}
