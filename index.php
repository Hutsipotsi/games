<?php
// Get DB connection
require 'db.php';
// Create SQL query to get all rows from a table
$sql = "SELECT * FROM tunniste";
// Execute the query
$tunniste = $pdo->query($sql);
// Check if any was returned


if ( $tunniste->rowCount() > 0 ){
    echo "<ul>";
    // Loop till there are no more rows
    while ( $row = $tunniste->fetch() ) {
        // Echo the data
        echo "<li>" . $row["valmistaja"] . " " . $row["malli"]. "</li>";
    }
    echo "</ul>";
    echo '<a class="btn btn-primary" href="person.php" role="button">Add person</a>';

}

//testi

//Tässä toinen tapa käydä kyselyn tulos läpi:
// foreach($people as $row){
//     echo "<li>" . $row["firstname"] . " " . $row["lastname"]. "</li>";
// }
