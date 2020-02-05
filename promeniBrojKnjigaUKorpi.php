<?php
include("init.php");
if(isset($_POST['submit'])){

    foreach($_POST['kolicina'] as $knjigaID => $val) {
        if($val==0) {
            unset($_SESSION['korpa'][$knjigaID]);
        }else{
            $_SESSION['korpa'][$knjigaID]['kolicina']=$val;
        }
    }

    header("Location: korpa.php");
}