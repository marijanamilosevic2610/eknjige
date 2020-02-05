<?php
require 'flight/Flight.php';
require '../init.php';

Flight::register('db', 'DBBroker', array(''));

Flight::route('/', function(){
});

Flight::route('GET /zanrovi', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var DBBroker $db */
	$db = Flight::db();
    $rezultati = $db->vratiZanrove();
    echo json_encode($rezultati);
});

Flight::route('GET /kupovine', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var DBBroker $db */
    $db = Flight::db();
    $rezultati = $db->vratiKupovine();
    echo json_encode($rezultati);
});

Flight::route('GET /stavke/@id', function($id){
    header("Content-Type: application/json; charset=utf-8");
    /** @var DBBroker $db */
    $db = Flight::db();
    $rezultati = $db->vratiStavke($id);
    echo json_encode($rezultati);
});

Flight::route('POST /unesiZanr', function()
{
    header("Content-Type: application/json; charset=utf-8");
    /** @var DBBroker $db */
    $db = Flight::db();
    $podaci = file_get_contents('php://input');
    $niz = json_decode($podaci,true);
    $rez = $db->unesiZanr($niz);
    if($rez)
    {
        $response = "OK!";
    }
    else
    {
        $response = "NOK!";

    }

    echo json_encode($response);

});

Flight::start();
