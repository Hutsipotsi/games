<?php
include PUBLIC_DIR . 'kayttaja.php';


$people = getPeople();

echo "<ul>";
foreach($people as $p){
    echo "<li>".$p["tunnus"]."</li>";
}
echo "</ul>";