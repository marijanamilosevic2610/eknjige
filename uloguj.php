<?php
include "init.php";

$username = $_POST['username'];
$password = $_POST['password'];
$tip = $_POST['tip'];

if($tip == 'admin'){
    $admin = $db->ulogujAdmina($username,$password);
    if($admin){
        $_SESSION['ulogovan'] = true;
        $_SESSION['kupac'] = null;
        $_SESSION['administrator'] = $admin;
        header("Location: index.php");
    }else{
        header("Location: login.php?poruka=Neuspesno logovanje administratora");
    }
}elseif($tip == 'kupac'){
    $kupac = $db->ulogujKupca($username,$password);
    if($kupac){
        $_SESSION['ulogovan'] = true;
        $_SESSION['kupac'] = $kupac;
        $_SESSION['administrator'] = null;
        header("Location: index.php");
    }else{
        header("Location: login.php?poruka=Neuspesno logovanje kupca");
    }
}