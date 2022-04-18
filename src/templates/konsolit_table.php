<?php

//include TEMPLATES_DIR . 'header.php';

function getKonsolit($pid){
    
    require_once MODULES_DIR.'db.php';

if (!empty($_POST["valmistaja"])) {


    $pdo = getPdoConnection();
    //Haetaan tiedot ja aikaerot henkilölle
    $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste" AND "valmistaja=?";
 
    $statement = $pdo->prepare($sql);
    $statement->bindParam(1, $pid);
    $statement->execute();

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
}
