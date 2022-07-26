<?php
require 'vendor/autoload.php';
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/examen/statements");


$prefixes = "PREFIX : <http://biancadiana.ro#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> ";


if(!empty($_GET["idcopac"]))
{

$interogare= $prefixes. "DELETE WHERE 
                        { ?categorie :hasTrees :".$_GET["idcopac"].".
                        :".$_GET["idcopac"]." 
                                    rdfs:label ?label;
                                    :hasPicture ?imagine;
                                    :hasHeight    ?inaltime;
                                    :hasAvgAge        ?varsta;
                                    :bloomsFlowers	?flori;
                                    :livesInContinent	?continent. }";
 }
$client->update($interogare)."<br/>";

?>