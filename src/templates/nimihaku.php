<?php

function getPelitNimi () {
    require_once MODULES_DIR.'db.php';

    if(isset($_POST['Hae'])) {
    
    if(!empty($_POST['nimihaku'])) {

        if($nimihaku) {
            $pdo = getPdoConnection();
            
            $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli AS konsoli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND nimi LIKE '%$nimihaku%';";
        }
        $statement = $pdo->prepare($sql);
        $result = $statement->fetchAll();
        
        echo "<table class='table table border celpadding=5'><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>";
        //Luodaan yksi taulukon rivi tietokannan rivistä
        foreach($result as $row){ 
            echo "<tr><td>".$row["nimi"]."</td>";
            echo "<td>".$row["tyylilaji"]."</td>";
            echo "<td>".$row["ikasuositus"]."</td>";
            echo "<td>".$row["malli"]."</td></tr>";
        }
        echo "</table>";
    }
}
}
?>