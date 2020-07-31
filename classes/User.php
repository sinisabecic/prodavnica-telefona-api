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


    public function ValidanTelefon($phone)
    {
        // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        // Remove "-" from number
        $phone_to_check = str_replace("-", "", $filtered_phone_number);
        // Check the lenght of number
        // This can be customized if you want phone number from a specific country
        if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
            return false;
        } else {
            return true;
        }
    }


    public function admin_add_user($name, $address, $city, $country, $zip, $phone, $email, $username, $password, $is_admin)
    {
        $encode_password = base64_encode($password);

        $data_array =  array(
            "name" => $name,
            "address" => $address,
            "city" => $city,
            "country" => $country,
            "zip" => $zip,
            "phone" => $phone,
            "username" => $username,
            "email" => $email,
            "password" => $encode_password,
            "is_admin" => $is_admin
        );

        $rez = AddUser(json_encode($data_array));
        
        
        $mailquery = "SELECT * FROM tbl_users WHERE email='$email' or username='$username' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        
        if ($mailchk != false) { // ! alert za mongoDB
            $msg = "<div class='alert alert-warning' role='alert'>Ovaj korisnik vec postoji.</div>";
            return $msg;
        } else {
            $content = $rez->get_content();
            $id = $content["_id"];
        
            $query = "insert into tbl_users set
                        id='$id',
                        username='$username',
                        password='$encode_password',
                        email='$email',
                        name='$name',
                        address='$address',
                        phone='$phone',
                        zip='$zip',
                        city='$city',
                        country='$country',
                        is_admin='$is_admin'";

            $result = $this->db->insert($query);

            if (!$result and $rez->get_statusCode() != "201") { // ! alert za mysql i mongo
                $msg = "<div class='alert alert-danger' role='alert'>Greška. Korisnik nije dodat. Pokušajte ponovo. 
                <a href='/admin/pages/tables/users.php'class='alert-link'> Vrati se</a>.</div> ";
                return $msg;
            } else { // !* Alert za uspjesno dodavanje
                $msg = "<div class='alert alert-success' role='alert'>Korisnik uspješno dodat.  
                <a href='/admin/pages/tables/users.php'class='alert-link'> Vrati se</a>.</div>";
                return $msg;
            }
        }
    }

    public function user_register($name, $address, $city, $country, $zip, $phone, $email, $username, $password)
    {
        $encode_password = base64_encode($password);

        $data_array =  array(
            "name" => $name,
            "address" => $address,
            "city" => $city,
            "country" => $country,
            "zip" => $zip,
            "phone" => $phone,
            "username" => $username,
            "email" => $email,
            "password" => $encode_password,
            "is_admin" => "0"
        );

        $rez = AddUser(json_encode($data_array));

        
        $mailquery = "SELECT * FROM tbl_users WHERE email='$email' or username='$username' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        
        if ($mailchk != false) { // ! alert ako postoji korisnik
            $msg = "<script>
            $.toast({
            text: 'Pokušajte ponovo.',
            heading: 'Korisnik već postoji!',
            icon: 'warning',
            showHideTransition: 'slide',
            allowToastClose: true,
            hideAfter: 3000,
            stack: 5,
            position: 'top-center',
            textAlign: 'left',
            loader: false,
            loaderBg: '#9EC600',
        });
            </script>";
            return $msg;
        } else {
            // ! Dio koji kupi unesene podatke u mongo
            $content = $rez->get_content();
            $id = $content["_id"];
      
            // ! Sql unos
            $query = "insert into tbl_users set
                        id= '$id',                      
                        username='$username',
                        password='$encode_password',
                        email='$email',
                        name='$name',
                        address='$address',
                        phone='$phone',
                        zip='$zip',
                        city='$city',
                        country='$country',
                        is_admin='0' ";
            $result = $this->db->insert($query);
  
            if (!$result and $rez->get_statusCode() != "201") { // ! alert za mysql i mongodb
                $msg = "<script>
                $.toast({
                text: 'Pokušajte ponovo.',
                heading: 'Greška pri registraciji!',
                icon: 'error',
                showHideTransition: 'slide',
                allowToastClose: true,
                hideAfter: 3000,
                stack: 5,
                position: 'top-center',
                textAlign: 'left',
                loader: false,
                loaderBg: '#9EC600',
            });
                </script>";
                return $msg;
            } else {
                $msg = "<script>
            $.toast({
                text: 'Možete se prijaviti.',
                heading: 'Registracija je uspješna!',
                icon: 'success',
                showHideTransition: 'slide',
                allowToastClose: true,
                hideAfter: 3000,
                stack: 5,
                position: 'top-center',
                textAlign: 'left',
                loader: false,
                loaderBg: '#9EC600',
            });
                </script>";
                return $msg;
            }
        }
    }



    public function login($username, $password)
    {
        $encode_password = base64_encode($password);
        
        $rez = GetByUsernameAndPass($username, $encode_password);
        $content = $rez->get_content();

        if ($rez->get_statusCode() == "201") {
            $_SESSION['cuslogin'] = true;
            $_SESSION['cmrId'] = $content[0]["_id"];
            $_SESSION['cmrUser'] = $username;
            $_SESSION['cmrName'] = $content[0]["name"];
            $_SESSION['is_admin'] = $content[0]["is_admin"];
            $_SESSION['email'] = $content[0]["email"];
            $customer = $_SESSION['cmrName'];

            $loginmsg = "<script>
            $.toast({
                text: 'Dobrodošli $customer',
                heading: 'Prijava je uspješna!', 
                icon: 'success', 
                showHideTransition: 'slide',
                allowToastClose: true, 
                hideAfter: 3000, 
                stack: 5, 
                position: 'top-center',               
                textAlign: 'left', 
                loader: false,  
                loaderBg: '#9EC600',              
            });            
            window.setTimeout(function(){
                window.location.href = '/';        
            }, 1500);
            </script>";
            return $loginmsg;

        // return json_encode(array(
            //     'login' => $_SESSION['cuslogin'],
            //     'user_id' => $_SESSION['cmrId'],
            //     'username' => $_SESSION['cmrUser'],
            //     'email' => $_SESSION['email'],
            //     'is_admin' => $_SESSION['is_admin'],
            //     'name' => $_SESSION['cmrName']
            // ));
        } else {
            $loginmsg = "<script>
            $.toast({
                text: 'Pogrešno uneseni podaci. Pokušajte ponovo.',
                heading: 'Greška',
                icon: 'error', 
                showHideTransition: 'slide', 
                allowToastClose: true, 
                hideAfter: 3000, 
                stack: 5, 
                position: 'top-center', 
                textAlign: 'left',  
                loader: false,  
                loaderBg: '#9EC600',            
            })            
            </script>";
            return $loginmsg;
        }
    }



    public function update($id, $name, $address, $city, $country, $zip, $phone, $email, $username, $password, $admin)
    {
        $encode_password = base64_encode($password);

        $data_array =  array(
            "name" => $name,
            "address" => $address,
            "city" => $city,
            "country" => $country,
            "zip" => $zip,
            "phone" => $phone,
            "username" => $username,
            "email" => $email,
            "password" => $encode_password,
            "is_admin" => $admin
        );

        $emailSession = Session::get("email");
        $usernameSession = Session::get("cmrUser");

        $rez = UpdateByID($id, json_encode($data_array));
        
        $mailquery = "SELECT * FROM tbl_users WHERE email='$email' OR username='$username' LIMIT 1";
        $mailchk = $this->db->select($mailquery);

        // ! Ukoliko korisnik unosi svoje iste podatke ili oce samo da sacuva svoje podatke, dopusti mu da to uradi
        $mailquerysession = "SELECT * FROM tbl_users WHERE email='$emailSession' 
                             AND username='$usernameSession' LIMIT 1";
        $checksession = $this->db->select($mailquerysession);

        if ($mailchk != false and $checksession == false) {
            $msg = "<div class='alert alert-danger' role='alert'>Korisnik sa tim podacima već postoji. 
            <a href='/admin/pages/tables/users.php'class='alert-link'> Vrati se</a>.</div></div>";
            return $msg;
        } else {
            $string = 'update tbl_users 
                    set 
                    name="'.$name.'", 
                    username="'.$username.'",
                    address="'.$address.'",                    
                    zip="'.$zip.'",
                    phone="'.$phone.'",
                    country="'.$country.'",
                    city="'.$city.'",
                    email="'.$email.'", 
                    password="'.$encode_password.'", 
                    is_admin="'.$admin.'" 
                    where id="'.$id.'"';
            $result = $this->db->update($string);

            if (!$result and $rez->get_statusCode() != "201") {
                $msg = "<div class='alert alert-danger' role='alert'>Greška. 
            <a href='/admin/pages/tables/users.php'class='alert-link'> Vrati se</a>.</div></div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-success' role='alert'>Uspješno izmijenjeno. 
            <a href='/admin/pages/tables/users.php'class='alert-link'> Vrati se</a>.</div></div>";
                return $msg;
            }
        }
    }
    
    
    // ! Ovo je identicna funkcija kao ova iznad. Samo sto ova radi sa adminske strane.
    // ! Ovo mi je trebalo zbog alerta
    public function userUpdate($id, $name, $address, $city, $country, $zip, $phone, $email, $username, $password, $is_admin)
    {
        // ? Ovo je enkripcija sifre
        $encode_password = base64_encode($password);

        $data_array =  array(
            "name" => $name,
            "address" => $address,
            "city" => $city,
            "country" => $country,
            "zip" => $zip,
            "phone" => $phone,
            "username" => $username,
            "email" => $email,
            "password" => $encode_password,
            "is_admin" => $is_admin
        );
        $emailSession = Session::get("email");
        $usernameSession = Session::get("cmrUser");

        $rez = UpdateByID($id, json_encode($data_array));
        
        $mailquery = "SELECT * FROM tbl_users WHERE email='$email' OR username='$username' LIMIT 1";
        $mailchk = $this->db->select($mailquery);

        // ! Ukoliko korisnik unosi svoje iste podatke ili oce samo da sacuva svoje podatke, dopusti mu da to uradi
        $mailquerysession = "SELECT * FROM tbl_users WHERE email='$emailSession' 
                             AND username='$usernameSession' LIMIT 1";
        $checksession = $this->db->select($mailquerysession);

        if ($mailchk != false and $checksession == false) {
            $msg = "<script>
            $.toast({
            text: 'Pokušajte ponovo sa drugim mejlom ili korisničkim imenom.',
            heading: 'Korisnik već postoji!',
            icon: 'warning',
            showHideTransition: 'slide',
            allowToastClose: true,
            hideAfter: 3000,
            stack: 5,
            position: 'top-center',
            textAlign: 'left',
            loader: false,
            loaderBg: '#9EC600',
        });
            </script>";
            return $msg;
        } else {
            $string = 'update tbl_users 
                    set 
                    name="'.$name.'", 
                    username="'.$username.'",
                    address="'.$address.'",                    
                    zip="'.$zip.'",
                    phone="'.$phone.'",
                    country="'.$country.'",
                    city="'.$city.'",
                    email="'.$email.'", 
                    password="'.$encode_password.'", 
                    is_admin="'.$is_admin.'" 
                    where id="'.$id.'"';
            $result = $this->db->update($string);
       
            if (!$result and $rez->get_statusCode() != "201") {
                $msg = "<script>
            $.toast({
                text: '',
                heading: 'Greška!', 
                icon: 'error', 
                showHideTransition: 'slide',
                allowToastClose: true, 
                hideAfter: 3000, 
                stack: 5, 
                position: 'top-center',               
                textAlign: 'left', 
                loader: false,  
                loaderBg: '#9EC600',              
            });          
            </script>";
                return $msg;
            } else {
                $msg = "<script>
            $.toast({
                text: '',
                heading: 'Uspješno izmijenjeno!', 
                icon: 'success', 
                showHideTransition: 'slide',
                allowToastClose: true, 
                hideAfter: 3000, 
                stack: 5, 
                position: 'top-center',               
                textAlign: 'left', 
                loader: false,  
                loaderBg: '#9EC600',              
            });          
            </script>";
                return $msg;
            }
        }
    }



    public function getUserData($id)
    {
        $query = "SELECT * FROM tbl_users WHERE id ='$id' ";
        $result = $this->db->select($query);
        return $result;
    }


    public function getUsers()
    {
        $query = "SELECT * FROM tbl_users";
        $result = $this->db->select($query);
        return $result;
    }


    public function deleteUser($id)
    {
        $rez = DeleteById($id);
        if ($rez) {
            echo "<script>
            $.toast({
                text: '',
                heading: 'Korisnik je uklonjen!', 
                icon: 'success', 
                showHideTransition: 'slide',
                allowToastClose: true, 
                hideAfter: 3000, 
                stack: 5, 
                position: 'top-center',               
                textAlign: 'left', 
                loader: false,  
                loaderBg: '#9EC600',              
            });          
            </script>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Greška. Pokušajte ponovo.</div>";
        }
        
        $query = "DELETE FROM tbl_users where id='$id' ";
        $result = $this->db->delete($query);
        return $result;
    }
}
