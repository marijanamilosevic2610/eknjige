<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand" href="#"><img src="images/logo.png" alt="img" class="mobile_logo_width"/></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Prodanica <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="korpa.php">Korpa <span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                    if($_SESSION['ulogovan']){
                        if($_SESSION['kupac']){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="zavrsiKupovinu.php">Checkout <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="mojekupovine.php">Moje kupovine <span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                        }
                        if($_SESSION['administrator']){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="adminStrane.php">Admin strane <span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                        </li>
                    <?php
                    }else{
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registracija.php">Nemate nalog <span class="sr-only">(current)</span></a>
                        </li>
                    <?php

                    }
                    ?>

                </ul>
            </div>
        </nav>
    </div>
</div>