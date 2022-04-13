<?php
include "../../src/templates/header.php";
include "kayttaja.php";


$people = getPeople();

echo "<ul>";
foreach($people as $p){
    echo "<li>".$p["tunnus"]."</li>";
}
echo "</ul>";