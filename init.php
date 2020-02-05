<?php
session_start();

if(!isset($_SESSION['ulogovan'])){
    $_SESSION['ulogovan'] = false;
    $_SESSION['kupac'] = null;
    $_SESSION['administrator'] = null;
}

if(!isset($_SESSION['korpa'])){
    $_SESSION['korpa'] = [];
}

include "DBBroker.php";
$db = new DBBroker();