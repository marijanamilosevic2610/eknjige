<?php
include "init.php";

$curl = curl_init("http://localhost/eknjige/api/zanrovi");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$jsonOdgovor = curl_exec($curl);
$zanrovi = json_decode($jsonOdgovor);
curl_close($curl);
?>


<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Knjige</title>
    <link href="css/media_query.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="css/style_1.css" rel="stylesheet" type="text/css"/>
    <script src="js/modernizr-3.5.0.min.js"></script>
</head>
<body>
<div class="container-fluid fh5co_header_bg">
    <div class="container">
        <div class="row">
            <div id="topHeader" class="col-12 "><a href="#" class="color_fff fh5co_mediya_setting"><i
                    class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;<span id="time"></span></a>
                </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 fh5co_padding_menu">
                <img src="images/logo.jpg" alt="img" class="fh5co_logo_width"/>
            </div>
            <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="#" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="#" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div></a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php include 'header.php'; ?>

<div class="container-fluid pt-3">
    <div class="container animate-box" data-animate-effect="fadeIn">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Nasa mala knjizara</div>
        </div>
        <div class="row">
            <h2>Unos knjige</h2>
            <div class="col-md-12">
                <label for="zanrovi">Zanr</label>
                <select class="form-control" id="zanrovi">
                    <?php
                    foreach ($zanrovi as $zanr){
                        ?>
                    <option value="<?= $zanr->zanrID ?>"><?= $zanr->nazivZanra ?></option>
                    <?php
                    }
                    ?>

                </select>
                <label for="naziv">Naziv knjige</label>
                <input type="text" id="naziv" class="form-control">
                <label for="cena">Cena knjige</label>
                <input type="text" id="cena" class="form-control">
                <label for="autor">Autor knjige</label>
                <input type="text" id="autor" class="form-control">
                <label for="nastanju">Knjiga na stanju</label>
                <input type="text" id="nastanju" class="form-control">
            </div>

            <div class="col-md-12" style="padding-top: 15px;">
                <button class="btn btn-primary" onclick="unesiKnjigu()" id="pretraga">Unesi knjigu</button>
            </div>
            <div class="col-md-12" style="padding-top: 15px;" id="rezultat">

            </div>
        </div>
        <div class="row">
            <table class="table" id="kupovine">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Ukupna cena</th>
                    <th class="text-center">Datum</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Prihvati</th>
                    <th class="text-center">Odbi</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $mojeKupovine = $db->vratiKupovine();

                foreach ($mojeKupovine as $kupovina) {

                    ?>
                    <tr>
                        <td><?php echo $kupovina->id ?></td>
                        <td><?php echo $kupovina->ukupanIznos ?> dinara</td>
                        <td><?php echo $kupovina->datumKupovine ?></td>
                        <td>
                            <?php
                            $klasa = "-";
                            if($kupovina->statusKupovine == 'Obrada'){
                                $klasa = "text-warning";
                            }
                            if($kupovina->statusKupovine == 'Zavrsena'){
                                $klasa = "text-success";
                            }
                            if($kupovina->statusKupovine == 'Odbijena'){
                                $klasa = "text-danger";
                            }
                            ?>

                            <span class="<?php echo $klasa ?>"><?php echo $kupovina->statusKupovine ?></span></td>
                            <td>

                                <?php

                            if($kupovina->statusKupovine == 'Obrada'){
                                ?>
                                <a href="prihvatiKupovinu.php?id=<?php echo $kupovina->id ?>" class="btn btn-success">Prihvati</a>
                                <?php
                            }
                            ?>
                            </td>
                        <td>

                            <?php

                            if($kupovina->statusKupovine == 'Obrada'){
                                ?>
                                <a href="odbiKupovinu.php?id=<?php echo $kupovina->id ?>" class="btn btn-danger">Odbi</a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="piechart" style="width: 600px; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid fh5co_footer_right_reserved">
    <div class="container">
        <div class="row  ">
            <div class="col-12 col-md-6 py-4 Reserved"> © Copyright 2020, All rights reserved. </div>
        </div>
    </div>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/main.js"></script>
<script>
    (function () {
        function checkTime(i) {
            return (i < 10) ? "0" + i : i;
        }

        function startTime() {
            var today = new Date(),
                h = checkTime(today.getHours()),
                m = checkTime(today.getMinutes()),
                s = checkTime(today.getSeconds());
            document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
            t = setTimeout(function () {
                startTime()
            }, 500);
        }
        startTime();
    })();
</script>
<script>
    function unesiKnjigu(){

        $.ajax({
            url: 'unosKnjige.php',
            type: 'POST',
            data: {
                naziv : $("#naziv").val(),
                autor : $("#autor").val(),
                zanr : $("#zanrovi").val(),
                cena : $("#cena").val(),
                nastanju : $("#nastanju").val()
            },
            success: function (poruka) {
                $("#rezultat").html(poruka);
            }
        })
    }

</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(grafik1);

    function grafik1() {

        $.ajax({
            url: 'api/podaciGrafik',
            success: function (podaci) {

                let nizZaChart = [['Knjiga','Broj kupovina']];

                $.each(podaci, function (i,podatak) {
                    nizZaChart.push([podatak.nazivKnjige,parseInt(podatak.brojKupovina)]);
                })
                var data = google.visualization.arrayToDataTable(nizZaChart);

                var options = {
                    title: 'Broj kupovina po knjizi', pieHole: 0.2
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        })


    }
</script>

</body>
</html>