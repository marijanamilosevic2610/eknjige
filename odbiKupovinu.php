<?php
include "init.php";
$kupovinaID = $_GET['id'];
$db->promeniStatusKupovine($kupovinaID,'Odbijena');

$stavke = $db->vratiStavke($kupovinaID);
foreach ($stavke as $stavka){
    $db->povecajBrojKnjigaNaLageru($stavka->knjigaID,$stavka->brojKnjiga);
}
header("Location: adminStrane.php");