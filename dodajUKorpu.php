<?php
 require("init.php");
 $id=intval($_GET['id']);

 if(isset($_SESSION['korpa'][$id])){
    header("Location: korpa.php");
}else{
    $knjiga = $db->findByID($id);

   $_SESSION['korpa'][$knjiga->knjigaID] = [
       "kolicina" => 1,
       "cena" => $knjiga->cena
   ];

   header("Location: index.php");

}

