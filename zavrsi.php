<?php
include("init.php");

$knjigeIzKorpe = implode(",",array_keys($_SESSION['korpa']));
$nizKnjigaIzKorpe = $db->vratiKnjigePoIdijevima($knjigeIzKorpe);

$ukupno = 0;
$greske = [];

foreach ($nizKnjigaIzKorpe as $knjiga) {
    $ukupnoStavka = $_SESSION['korpa'][$knjiga->knjigaID]['kolicina'] * $knjiga->cena;
    $ukupno += $ukupnoStavka;
    if($knjiga->naStanju < $_SESSION['korpa'][$knjiga->knjigaID]['kolicina']){
        $greske[] = "Knjiga {" . $knjiga->nazivKnjige . "} trenutno na stanju ima ".$knjiga->naStanju." knjiga a vi zelite da kupite " . $_SESSION['korpa'][$knjiga->knjigaID]['kolicina'] . ". Molimo vas da popravite to!";
    }
}
$now =date("Y-m-d H:i:s");
$kupacID = $_SESSION['kupac']->kupacID;

if(empty($greske)){
    $uspesno = $db->unosiKupovinu($kupacID,$ukupno,$now,"Obrada");
    if($uspesno){
        $kupovinaID = $db->vratiKupovinaID();
        foreach ($nizKnjigaIzKorpe as $knjiga) {
            $kolicina = $_SESSION['korpa'][$knjiga->knjigaID]['kolicina'];
            $id = $knjiga->knjigaID;
            $db->unesiStavku($id,$kupovinaID,$kolicina);
            $db->smanjiBrojKnjigaNaLageru($id,$kolicina);
        }

        $_SESSION['korpa'] = [];

        echo('Kupovina je uspesna');
    }
}else{
    echo implode(", ",$greske);
}