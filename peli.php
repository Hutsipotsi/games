<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Pelit</title>
</head>
<body>
    <header id="header" >Pelitietokanta</header>


<form action="" method="POST">
<label for="kasikonsolit">Käsikonsolit</label>
<select name="kasikonsolit" id="kasikonsolit">
    <option value="Kaikki">Kaikki</option>
    <option value="Valitse" selected="selected">Valitse</option>
</select>

<nav id="navigointi"></nav>

<?php 
require './src/modules/db.php';

//Haetaan valikkoon lista tietokannan pelityyleistä
$sql = "SELECT DISTINCT valmistaja FROM pelikonsoli ORDER BY valmistaja asc";

$pelikonsolit = $pdo->query($sql);

if ($pelikonsolit->rowCount() > 0) {
    echo '<label for="pelikonsoli">Pelikonsolit:</label>
    <select name="valmistaja">';
    
    foreach ($pelikonsolit as $row) {
        echo '<option value="' .$row["valmistaja"] .'">' . $row["valmistaja"] . '</option>';
    }
    echo '</select><br/>';
}

$sql = "SELECT DISTINCT tyylilaji FROM peli WHERE tyylilaji NOT LIKE '%/%' ORDER BY tyylilaji asc";

$genre = $pdo->query($sql);

if ($genre->rowCount() > 0) {
    echo '<label for="tyylilaji">Tyylilajit:</label>
    <select name="tyylilaji">';
    
    foreach ($genre as $row) {
        echo '<option value="' .$row["tyylilaji"] .'">' . $row["tyylilaji"] . '</option>';
    }
    echo '</select><br/>';
}


//Haetaan valikkoon lista
$sql = "SELECT DISTINCT malli FROM konsoli WHERE malli NOT LIKE '%Hero%' AND malli NOT LIKE '%Groud%' AND malli NOT LIKE '%Micro%' AND malli NOT LIKE '%One%' ORDER BY malli asc";

$konsolit = $pdo->query($sql);

if ($konsolit->rowCount() > 0) {
    echo '<label for="konsolit">Konsolit:</label>
    <select name="konsolit">';
    
    foreach ($konsolit as $row) {
        echo '<option value="' .$row["malli"] .'">' . $row["malli"] . '</option>';
    }
    echo '</select><br/>';
}


echo '<input type="submit" name="submit" value="Hae"/>';




?>
</form>
<footer id="footer"></footer>
</body>
</html>