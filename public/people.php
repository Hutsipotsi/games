<?php
include PUBLIC_DIR . 'kayttaja.php';


$tunnus = filter_input(INPUT_GET, "tunnus");
// If id parameter exists -> delete
if(isset($tunnus)){
    try{
        deletePerson($tunnus);
        echo '<div class="alert alert-success" role="alert">Person deleted!!</div>';
    }catch(Exception $e){
        echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
    }
    
}

$people = getPeople();

echo "<ul>";
foreach($people as $p){
    echo "<li>".$p["tunnus"]. '<a href="people.php?id=' . $p["id"] . '" class="btn btn-secondary">Delete</a> </li>';
}
echo "</ul>";