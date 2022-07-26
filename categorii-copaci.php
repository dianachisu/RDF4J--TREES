<?php 

require 'vendor/autoload.php';
$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/examen");

$prefixes = "PREFIX : <http://biancadiana.ro#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> ";


$interogare=$prefixes . "SELECT ?idcategorie ?categorie WHERE {?idcategorie a :TreeCategory; rdfs:label ?categorie}";
$categoriiCopaci=$client->query($interogare);

foreach ($categoriiCopaci as $categorieCopac)
{
    $idcategorie = $categorieCopac->idcategorie;
    $denumireCategorie = $categorieCopac->categorie;
	echo "<li id='".$idcategorie."' onclick='afisareCopaci(`".$idcategorie."`)'>" . $denumireCategorie . "</li>";
}

?>