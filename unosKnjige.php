<?php
include 'init.php';

$naziv = $_POST['naziv'];
$cena = $_POST['cena'];
$autor = $_POST['autor'];
$zanr = $_POST['zanr'];
$nastanju= $_POST['nastanju'];

if($db->unesiKnjigu($naziv,$autor,$cena,$zanr,$nastanju)){
    echo "Uspesno unesta knjgia";
}else{
    echo "Doslo je do greske";
}