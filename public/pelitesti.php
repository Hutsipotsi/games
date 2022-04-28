<?php

include MODULES_DIR . 'db.php';
include TEMPLATES_DIR . 'header.php';

$nimihaku = filter_input(INPUT_POST, "nimihaku", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$genre[] = filter_input(INPUT_POST, "tyylilaji");
$pvalmistaja = filter_input(INPUT_POST, "pvalmistaja", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pmalli = filter_input(INPUT_POST, "pmalli");
$konsoli = filter_input(INPUT_POST, "konsoli", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$pdo = getPdoConnection();

    //Haetaan valikkoon lista valmistajista
    $sql = "SELECT DISTINCT valmistaja FROM konsolitunniste ORDER BY valmistaja asc";

    $pvalmistaja = $pdo->query($sql);

    echo '<form action="pelitesti.php" method="post">';
    if ($pvalmistaja->rowCount() > 0) {
        echo '<label for="valmistaja" class="col-sm-2 col-form-label">Pelit valmistajittain:</label>
        <select name="pvalmistaja">';

        foreach ($pvalmistaja as $row) {
            echo '<option value="' . $row["valmistaja"] . '">' . $row["valmistaja"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select></form>';
    }

     //Haetaan valikkoon lista konsoleista
     $sql = "SELECT DISTINCT malli FROM konsolitunniste WHERE malli NOT LIKE '%Hero%' AND malli NOT LIKE '%Groud%' AND malli NOT LIKE '%Micro%' AND malli NOT LIKE '%One%' ORDER BY malli asc";

     $pmalli = $pdo->query($sql);
    
     echo '<form action="pelitesti.php" method="post">';
     if ($pmalli->rowCount() > 0) {
         echo '<label for="malli" class="col-sm-2 col-form-label">Pelit konsoleittain:</label>
         <select name="pmalli">';
 
         foreach ($pmalli as $row) {
             echo '<option value="' . $row["malli"] . '">' . $row["malli"] . '</option>';
         }
         echo '<option value="Valitse" selected="selected">Valitse</option></select></form>';
     }

     //Haetaan valikkoon tyylilajit
    $sql = "SELECT DISTINCT tyylilaji FROM genre ORDER BY tyylilaji asc";

    $genre = $pdo->query($sql);

    echo '<form action="pelitesti.php" method="post">';
    if ($genre->rowCount() > 0) {
        echo '<label for="tyylilaji" class="col-sm-2 col-form-label">Pelit tyylilajeittain:</label>
        <select name="tyylilaji">';

        foreach ($genre as $row) {
            echo '<option value="' . $row["tyylilaji"] . '">' . $row["tyylilaji"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select></form>';
    }

    //Haetaan valikkoon lista valmistajista
    $sql = "SELECT DISTINCT valmistaja FROM konsolitunniste WHERE malli NOT LIKE '%PC%' ORDER BY valmistaja asc";

    $konsoli = $pdo->query($sql);

    echo '<form action="pelitesti.php" method="post">';
    if ($konsoli->rowCount() > 0) {
        echo '<form action="peli.php" method="post"><label for="konsoli" class="col-sm-2 col-form-label">Konsolit:</label>
        <select name="konsoli">';

        foreach ($konsoli as $row) {
            echo '<option value="' . $row["valmistaja"] . '">' . $row["valmistaja"] . '</option>';
        }
        echo '<option value="pelikonsoli">Pelikonsolit</option><option value="kasikonsoli">Käsikonsolit</option><option value="konsoli">Kaikki</option><option value="Valitse" selected="selected">Valitse</option></select></form>';
    }

    echo '<form action="pelitesti.php" method="post"><label for="nimihaku" class="col-sm-2 col-form-label">Nimihaku:</label><input type ="text" name="pelin_nimi"/>';

    echo '<div class="col-sm-2 "><input type="submit" name="Hae" value="Hae"/></div>';

    if(isset($nimihaku)) {
        getPelitNimi ($nimihaku); 
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