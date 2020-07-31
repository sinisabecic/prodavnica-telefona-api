<?php

// OVAJ FAJL SAM NAPRAVIO KAKO BI SE PREKO AJAXA BRISALO SVE IZ KORPE
require '../classes/Cart.php';

$cart = new Cart();


$id = $_POST['product_id'];

$cart->delProductByCart($id);
