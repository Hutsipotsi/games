
<?php
    require 'db.php';

    include 'src/templates/header.php';

    $pdo = getPdoConnection();

    //Haetaan valikkoon lista valmistajista
    $sql = "SELECT DISTINCT valmistaja FROM konsolitunniste ORDER BY valmistaja asc";

    $pvalmistaja = $pdo->query($sql);

    if ($pvalmistaja->rowCount() > 0) {
        echo '<label for="valmistaja">Pelit valmistajittain:</label>
    <select name="pvalmistaja">';

        foreach ($pvalmistaja as $row) {
            echo '<option value="' . $row["valmistaja"] . '">' . $row["valmistaja"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select><br/>';
    }

    echo '<br/>';

    //Haetaan valikkoon lista konsoleista
    $sql = "SELECT DISTINCT malli FROM konsolitunniste WHERE malli NOT LIKE '%Hero%' AND malli NOT LIKE '%Groud%' AND malli NOT LIKE '%Micro%' AND malli NOT LIKE '%One%' ORDER BY malli asc";

    $pmalli = $pdo->query($sql);

    if ($pmalli->rowCount() > 0) {
        echo '<label for="malli">Pelit konsoleittain:</label>
    <select name="pmalli">';

        foreach ($pmalli as $row) {
            echo '<option value="' . $row["malli"] . '">' . $row["malli"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select><br/>';
    }

    echo '<br/>';

    //Haetaan valikkoon tyylilajit
    $sql = "SELECT DISTINCT tyylilaji FROM genre ORDER BY tyylilaji asc";

    $genre = $pdo->query($sql);

    if ($genre->rowCount() > 0) {
        echo '<label for="tyylilaji">Pelit tyylilajeittain:</label>
    <select name="tyylilaji">';

        foreach ($genre as $row) {
            echo '<option value="' . $row["tyylilaji"] . '">' . $row["tyylilaji"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select><br/>';
    }

    echo '<br/>';

    //Haetaan valikkoon lista valmistajista
    $sql = "SELECT DISTINCT valmistaja FROM konsolitunniste WHERE malli NOT LIKE '%PC%' ORDER BY valmistaja asc";

    $konsoli = $pdo->query($sql);

    if ($konsoli->rowCount() > 0) {
        echo '<label for="konsoli">Konsolit:</label>
    <select name="konsoli">';

        foreach ($konsoli as $row) {
            echo '<option value="' . $row["valmistaja"] . '">' . $row["valmistaja"] . '</option>';
        }
        echo '<option value="pelikonsoli">Pelikonsolit</option><option value="kasikonsoli">Käsikonsolit</option><option value="konsoli">Kaikki</option><option value="Valitse" selected="selected">Valitse</option></select><br/>';
    }

    echo '<br/>';

    echo '<label for="nimihaku" class="col-sm-2 col-form-label">Nimihaku:</label><input type ="text" name="pelin_nimi"/>';

    echo '<div class="col-sm-2 "><input type="submit" name="submit" value="Hae"/></div>';

    
?>

<?php

require_once 'db.php';

$submit=$_POST["Hae"];

if ($_POST["konsoli"]!="Valitse")
{
$konsoli=$_POST["konsoli"];
if ($konsoli=="Kaikki")
{
    $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste";

}
else {
    $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste" AND "valmistaja=?";
}

$statement = $pdo->query($sql);
    

    $result = $statement->fetchAll();
 
    echo "<table class='table table-striped'><tr><th>Valmistaja</th><th>Malli</th><th>kpl</th><th>Väri</th></tr>";
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach($result as $row){ 
        echo "<tr><td>".$row["valmistaja"]."</td>";
        echo "<td>".$row["malli"]."</td>";
        echo "<td>".$row["kpl"]."</td>";
        echo "<td>".$row["vari"]."</td></tr>";
    }
 
    echo "</table>";
}