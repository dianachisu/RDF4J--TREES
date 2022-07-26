<?php 
require 'vendor/autoload.php';

$client=new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/examen");

$prefixes = "PREFIX : <http://biancadiana.ro#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX xsd: <http://www.w3.org/2001/XMLSchema#> ";

/* FUNCTIE CARE SELECTEAZA COPACI IN FUNCTIE DE CATEGORIE */
function getTreeByCategory($idcategorie)
{
    global $client, $prefixes;
    $interogare = $prefixes . "SELECT  ?idcopac ?denumire ?inaltime ?varsta ?continent ?flori ?imagine 
                                WHERE {:".$idcategorie." a :TreeCategory.
                                    :".$idcategorie." :hasTrees ?idcopac.
                                    ?idcopac rdfs:label ?denumire.
                                    ?idcopac :hasHeight ?inaltime.
                                    ?idcopac :hasAvgAge ?varsta.
                                    ?idcopac :livesInContinent ?continent.
                                    ?idcopac :bloomsFlowers ?flori.
                                    ?idcopac :hasPicture ?imagine
                            }";
                            
    $copaciCategorie=$client->query($interogare);

    return $copaciCategorie;
}

/* DACA S-A TRANSMIS O CATEGORIE, APELEAZA FUNCTIA getTreeByCategory, PREIA COPACII DIN CATEGORIE SI II AFISEAZA */
if(!empty($_GET["idcategorie"]))
{
    echo "<h3>Categorie copaci:".$_GET['idcategorie']."</h3>";
    $detaliiCopaci = getTreeByCategory($_GET["idcategorie"]);
    foreach ($detaliiCopaci as $copac)
        {
            echo "<div class='div3'> ";
            echo "<ul><li><strong>" . $copac->denumire . "</strong></li>";
            echo "<li><input type='button' onclick='stergereCopac(`" .$copac->idcopac. "`)'  value='Sterge' class='buton-sterge'></li></ul>";
            echo "<img src='". $copac->imagine ."' alt='tree'>";
            echo "<ul><li>Inaltime:" . $copac->inaltime . "</li>";
            echo "<ul><li>Varsta maxima:" . $copac->varsta . "</li>";
            echo "<ul><li>Continent:" . $copac->continent . "</li>";
            echo "<ul><li>Infloreste:" . $copac->flori . "</li></ul></div>";
        }
}

?>