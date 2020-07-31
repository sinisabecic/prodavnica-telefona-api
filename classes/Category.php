<?php
 $filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');


 
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db   = new Database();
        $this->fm   = new Format();
    }

    public function catInsert($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName =  mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $msg = "<div class='alert alert-warning' role='alert'>
  Polje ne smije biti prazno! Pokusaj ponovo. <a href='catlist.php' class='alert-link'> Vrati se na spisak proizvodjaca.</a></div>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
            $catinsert = $this->db->insert($query);
            if ($catinsert) {
                $msg = "<div class='alert alert-success' role='alert'>
  Uspjesno dodato. <a href='catlist.php' class='alert-link'>Vrati se.</a>.
  </div> ";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger' role='alert'>
  Nije dodato! Pokusaj ponovo. <a href='catlist.php' class='alert-link'> Vrati se na spisak proizvodjaca</a>.</div>";
                return $msg;
            }
        }
    }


    public function getAllCat()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;
    }


    public function getCatById($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId ='$id' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function catUpdate($catName, $id)
    {
        $catName = $this->fm->validation($catName);
        $catName =  mysqli_real_escape_string($this->db->link, $catName);
        $id =  mysqli_real_escape_string($this->db->link, $id);
        if (empty($catName)) {
            $msg = "<div class='alert alert-warning' role='alert'>
  Polje ne smije biti prazno! Pokusaj ponovo. <a href='catlist.php' class='alert-link'> Vrati se na spisak proizvodjaca</a>.</div>";
            return $msg;
        } else {
            $query = "UPDATE tbl_category
            SET
            catName = '$catName'
            WHERE catId = '$id' ";
            $update_row  = $this->db->update($query);
            if ($update_row) {
                $msg = "<div class='alert alert-success' role='alert'>
  Uspjesno azurirano. <a href='catlist.php' class='alert-link'> Vrati se na spisak proizvodjaca.</a></div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger' role='alert'>
  Neuspjesno! Pokusaj ponovo. <a href='catlist.php' class='alert-link'> Vrati se na spisak proizvodjaca.</a></div>";
                return $msg;
            }
        }
    }


    public function delCatById($id)
    {
        $query = "DELETE FROM tbl_category WHERE catId ='$id' ";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<div class='alert alert-success' role='alert'>Izbrisano!</div> ";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Greska.</div> ";
            return $msg;
        }
    }

    public function count()
    {
        $query = "SELECT * FROM tbl_category";
        $select = $this->db->select($query);
        $result = mysqli_num_rows($select);
        return $result;
    }
}
