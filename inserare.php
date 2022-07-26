<?php
require 'vendor/autoload.php';

$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/examen/statements");

function statementDeInserare ($categorie, $idcopac, $denumire, $inaltime, $varsta, $continent, $flori, $imagine)
{

    $deTrimis=<<<EOD
    @prefix : <http://biancadiana.ro#>.
    @prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>.
    @prefix xsd: <http://www.w3.org/2001/XMLSchema#>.

    :$categorie :hasTrees	:$idcopac.

    :$idcopac		    rdfs:label "$denumire";
                :hasPicture "$imagine";
                :hasHeight    "$inaltime";
                :hasAvgAge        "$varsta";
                :bloomsFlowers	"$flori"^^xsd:boolean;
                :livesInContinent	"$continent".
EOD;
    return $deTrimis;
}

$categorie = $_GET["categorie"];
$denumire = $_GET["denumire"];
$idcopac = strtolower($denumire);
$inaltime = $_GET["inaltime"];
$varsta = $_GET["varsta"];
$continent = $_GET["continent"];
$imagine = $_GET["imagine"];
$flori = $_GET["flori"];


$deTrimis = statementDeInserare($categorie, $idcopac, $denumire, $inaltime, $varsta, $continent, $flori, $imagine);
$grafDeTrimis=new EasyRdf\Graph();
$grafDeTrimis->parse($deTrimis,"turtle");
$client->insert($grafDeTrimis,"http://biancadiana.ro#treesgraph");

?>