<?php

require 'vendor/autoload.php';
use aboras_19\Utakmica;
use Composer\Autoload\ClassLoader;

Flight::route('GET /utakmice', function(){
    
   $doctrineBootstrap = Flight::entityManager();
   $em = $doctrineBootstrap->getEntityManager();
   $repozitorij=$em->getRepository('aboras_19\Utakmica');
   $utakmice = $repozitorij->findAll();

   echo $doctrineBootstrap->getJson($utakmice);

});

Flight::route('POST /utakmice', function(){
  $utakmica = new Utakmica();
  $utakmica->setPodaci(Flight::request()->data);
  $utakmica->setDatum(new DateTime("now"));

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();

  $em->persist($utakmica);
  $em->flush();

  $poruka=new stdClass();
  $poruka->tekst="OK";
  $poruka->greska=false;
  $odgovor=new stdClass();
  $odgovor->poruka=$poruka;

  Flight::json($odgovor);

  header("HTTP/1.1 201 Created");

});


Flight::route('PUT /utakmice/@sifra', function($sifra){
    
    $doctrineBootstrap = Flight::entityManager();
    $em = $doctrineBootstrap->getEntityManager();
    $repozitorij=$em->getRepository('aboras_19\Utakmica');
    $utakmica = $repozitorij->find($sifra);

    $utakmica->setPodaci(Flight::request()->data);
    $em->persist($utakmica);
    $em->flush();
  
    $poruka=new stdClass();
    $poruka->tekst="OK";
    $poruka->greska=false;
    $odgovor=new stdClass();
    $odgovor->poruka=$poruka;
  
    Flight::json($odgovor);
  
  });

  Flight::route('DELETE /utakmice/@sifra', function($sifra){
    
    $doctrineBootstrap = Flight::entityManager();
    $em = $doctrineBootstrap->getEntityManager();
    $repozitorij=$em->getRepository('aboras_19\Utakmica');
    $utakmica = $repozitorij->find($sifra);

    $utakmica->setPodaci(Flight::request()->data);
    $em->remove($utakmica);
    $em->flush();
  
    $poruka=new stdClass();
    $poruka->tekst="OK";
    $poruka->greska=false;
    $odgovor=new stdClass();
    $odgovor->poruka=$poruka;
  
    Flight::json($odgovor);
  
  });

Flight::route('/', function(){
    $poruka=new stdClass();
    $poruka->tekst="Nepotpuni zahtjev";
    $poruka->kod=1;
    $poruka->greska=true;
    $poruka->detalji="https://upute.app.hr/blog/api/v1/greske/7";

    $odgovor=new stdClass();
    $odgovor->poruka=$poruka;

    Flight::json($odgovor);

});

$cl = new ClassLoader('aboras_19',__DIR__ . '/src');
$cl->register();
require_once 'bootstrap.php';
Flight::register('entityManager','DoctrineBootstrap');


Flight::start();