<?php
include "init.php";

$sort = $_GET['sort'];
$zanrID = $_GET['zanr'];

$knjige = $db->vratiAktivneKnjige($zanrID,$sort);
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Naziv knjige</th>
        <th>Cena knjige</th>
        <th>Autor knjige</th>
        <th>Na stanju</th>
        <th>Zanr knjige</th>
        <th>Dodaj u korpu</th>
    </tr>
    </thead>
    <tbody>
    <?php

        foreach ($knjige as $knjiga){
            ?>
    <tr>
        <td><?= $knjiga->nazivKnjige ?></td>
        <td><?= $knjiga->cena ?> din</td>
        <td><?= $knjiga->autor ?></td>
        <td><?= $knjiga->naStanju ?></td>
        <td><?= $knjiga->nazivZanra ?></td>
        <td><a href="dodajUKorpu.php?id=<?= $knjiga->knjigaID ?>" class="btn btn-primary">Dodaj u korpu</a></td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>
