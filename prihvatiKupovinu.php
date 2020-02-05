<?php
include "init.php";
$kupovinaID = $_GET['id'];
$db->promeniStatusKupovine($kupovinaID,'Zavrsena');
header("Location: adminStrane.php");