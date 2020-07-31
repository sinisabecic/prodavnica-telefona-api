<?php
 $filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 
include "UserAPI.php";
 
class User
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db   = new Database();
        $this->fm   = new Format();
    }

    public function count()
    {
        $query = "SELECT * FROM tbl_users";
        $select = $this->db->select($query);
        $result = mysqli_num_rows($select);
        return $result;
    }
}
