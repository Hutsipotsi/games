<?php

function getKonsolit(){
    require_once MODULES_DIR.'db.php';

   
    if(isset($_POST['Hae'])) {

    if(!empty($_POST["konsoli"])) {

        if($konsoli==="Kaikki") {

        $pdo = getPdoConnection();
        //Haetaan tiedot ja aikaerot henkilölle
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste";
        }
        elseif ($konsoli==='kasikonsoli' || $konsoli==='pelikonsoli') {
            "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND konsolityyppi = '$konsoli'";
        }
        else {
            $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND valmistaja='$konsoli'";
        }

        $statement = $pdo->prepare($sql);
        $result = $statement->fetchAll();
     
        echo "<table class='table table border celpadding=5'><tr><th>Valmistaja</th><th>Malli</th><th>kpl</th><th>Väri</th></tr>";
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
}
?>