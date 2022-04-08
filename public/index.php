

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css"/>
    <title>Pelit</title>
</head>
<body>
    <header id="header">Pelitietokanta</header>
   

<nav>
    <ul>
         <li><a href="index.php">Etusivu</a></li>
        <li><a href="peli.php">Pelit</a></li>
        <li><a href="login.php">Kirjaudu sisään</a></li>
    </ul>
</nav>

</div></div>

<?php




 if(isset($_session['tunnus'])){
     echo'welcome'.$_SESSION['tunnus']. " ".$_SESSION['salasana']. "</h1>";
 }else{
     echo '';
 }

 




// Get DB connection
require '../src/modules/db.php';
// Create SQL query to get all rows from a table
$sql = "SELECT * FROM konsolitunniste";
// Execute the query
$konsolitunniste = $pdo->query($sql);
// Check if any was returned


if ( $konsolitunniste->rowCount() > 0 ){
    echo "<ul>";
    // Loop till there are no more rows
    while ( $row = $konsolitunniste->fetch() ) {
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
?>

</form>
<footer id="footer"></footer>
</body>
</html>