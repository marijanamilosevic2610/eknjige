<?php
include "init.php";

$username = $_POST['username'];
$password = $_POST['password'];
$ime = $_POST['ime'];
$uspesno = $db->unesiKupca($ime,$username,$password);

if($uspesno){
    header("Location: registracija.php?poruka=Upsesno ste se registrovali");
}else{
    header("Location: login.php?poruka=Neuspesna registracija");
}

