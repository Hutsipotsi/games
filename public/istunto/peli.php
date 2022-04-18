
<?php
    require '../src/modules/db.php';

    include TEMPLATES_DIR . 'header.php';

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

    echo '<strong>Nimihaku:</strong> &nbsp;&nbsp;<input type ="text" name="pelin_nimi"/>';

    echo '<input type="submit" name="submit" value="Hae"/>';

    include TEMPLATES_DIR . 'footer.php';
?>