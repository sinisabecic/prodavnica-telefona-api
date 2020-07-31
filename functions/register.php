<?php
require '../config/config.php';
require '../classes/UserModel.php';

$user = new UserModel();

session_start();

$username = $_POST['username'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$zip = $_POST['zip'];
$city = $_POST['city'];
$country = $_POST['country'];
$email = $_POST['email'];
$password = $_POST['password'];

// echo $username .'<br>';
// echo $name .'<br>';
// echo $address .'<br>';
// echo $phone .'<br>';
// echo $zip .'<br>';
// echo $city .'<br>';
// echo $country .'<br>';
// echo $email .'<br>';
// echo $password .'<br>';

// if ($username!='' && $email!='' && $password!='' && $name!='' && $address!='' && $zip!='' && $city!='' && $country!='') {
    if (isset($_POST['register'])) {
        $register = $user->register($name, $address, $city, $country, $zip, $phone, $email, $username, $password);
    
        if ($register) {
            $result = array('error'=>'Uspjesno');
            echo json_encode($result);
        } else {
            $result = array('error'=>'Greska');
            echo json_encode($result);
        }
    }
// } else {
//     header('Location: http://'.BASE_URL.'/login.php');
// }
