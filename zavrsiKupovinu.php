<?php
include "init.php";
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
            <h2 id="odgovor"></h2>

            <div class="col-md-12" style="padding-top: 15px;">
                <h2>Zavrsetak kupovine je moguc samo ukoliko ste ulogovani</h2>
                <?php

                if (empty($_SESSION['korpa'])){
                    echo "<h4>Nemate knjiga u korpi.</h4>";
                }else{
                    ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">Knjiga</th>
                                <th class="text-center">Kolicina</th>
                                <th class="text-center">Na stanju</th>
                                <th class="text-center">Cena</th>
                                <th class="text-center">Ukupno</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $knjigeIzKorpe = implode(",",array_keys($_SESSION['korpa']));
                            $nizKnjigaIzKorpe = $db->vratiKnjigePoIdijevima($knjigeIzKorpe);

                            $ukupno = 0;

                            foreach ($nizKnjigaIzKorpe as $knjiga) {
                                $ukupnoStavka = $_SESSION['korpa'][$knjiga->knjigaID]['kolicina'] * $knjiga->cena;
                                $ukupno += $ukupnoStavka;

                                ?>
                                <tr>
                                    <td><?php echo $knjiga->nazivKnjige ?></td>
                                    <td><?php echo $_SESSION['korpa'][$knjiga->knjigaID]['kolicina'] ?></td>
                                    <td><?php echo $knjiga->naStanju ?> komada</td>
                                    <td><?php echo $knjiga->cena ?> dinara</td>
                                    <td><?php echo $ukupnoStavka ?> dinara</td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="4">Ukupna cena: <?php echo $ukupno ?> dinara</td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                    <button id="zavrsiKupovinu" role="button" class="btn btn-primary btn-lg" onclick="zavrsiKupovinu()">Zavrsi kupovinu </button>

                <?php } ?>
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

    function zavrsiKupovinu(){

        $.ajax({
            url: "zavrsi.php",
            success: function(data){

                $('#odgovor').html(data);
            }});
    }

</script>

</body>
</html>