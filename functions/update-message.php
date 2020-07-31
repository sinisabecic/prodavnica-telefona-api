<?php

// OVAJ FAJL SAM NAPRAVIO KAKO BI SE PREKO AJAXA BRISALO SVE IZ KORPE
require '../classes/Contact.php';

$contact = new Contact();


$id = $_POST['message_id'];

$contact->setSeen($id);
