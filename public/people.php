<?php
include PUBLIC_DIR . 'kayttaja.php';


$id = filter_input(INPUT_GET, "id");
// If id parameter exists -> delete
if(isset($id)){
    try{
        deletePerson($id);
      
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