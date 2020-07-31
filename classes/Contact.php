<?php

 $filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 
?>

<?php
 
class Contact
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db   = new Database();
        $this->fm   = new Format();
    }

    public function sendMessage($data)
    {
        $name       =  mysqli_real_escape_string($this->db->link, $data['name']);
        $email 		=  mysqli_real_escape_string($this->db->link, $data['email']);
        $phone 		=  mysqli_real_escape_string($this->db->link, $data['phone']);
        $message 	=  mysqli_real_escape_string($this->db->link, $data['message']);

        $query = "INSERT INTO tbl_message(name, email, phone, message) 
          VALUES ('$name','$email','$phone','$message')";


        if ($name == "" || $email == "" || $phone == "" || $message == "") {
            $msg = "<div class='alert alert-warning' role='alert'>Popunite sva polja.</div> ";
            return $msg;
        }

        $message = $this->db->insert($query);

        if ($message) {
            $msg = "<div class='alert alert-success' role='alert'>Vaša poruka je poslata. Obratićemo Vam se u najkraćem roku.</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Provjerite da li ste ispravno unijeli podatke.</div>";
            return $msg;
        }
    }


    public function getAllMessages()
    {
        $query = "SELECT * FROM tbl_message ORDER BY m_id DESC";

        $result =  $this->db->select($query);
        return $result;
    }

    public function getUnreadMessages()
    {
        $query = "SELECT * FROM tbl_message WHERE status=0 ORDER BY m_id DESC";

        $result =  $this->db->select($query);
        return $result;
    }

    public function count()
    {
        $query = "SELECT * FROM tbl_message where status=0";
        $select = $this->db->select($query);
        $result = mysqli_num_rows($select);
        return $result;
    }


    public function setSeen($id)
    {
        $query = "UPDATE tbl_message
          SET status 	= 1          
          WHERE m_id = '$id' ";
          
        $result = $this->db->update($query);
        return $result;
    }


    public function deleteMessage($id)
    {
        $query = "delete from tbl_message where m_id='$id'";
        $result =  $this->db->delete($query);
        return $result;
    }
}
