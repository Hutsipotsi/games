
<?php
include MODULES_DIR . 'db.php';
include MODULES_DIR . 'skandikorjaus.php';
include TEMPLATES_DIR . 'header.php';
include TEMPLATES_DIR . 'pelihaut.php';


$nimihaku = charFix(filter_input(INPUT_POST, "nimihaku", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$tyylilaji = charFix(filter_input(INPUT_POST, "tyylilaji", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$valmistaja = filter_input(INPUT_POST, "valmistaja", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$malli = filter_input(INPUT_POST, "malli", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$konsoli = charFix(filter_input(INPUT_POST, "konsoli", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

echo '<div class=container><form action="pelit.php" method="post">';

echo '<h3 id="oetu">Pelit ja konsolit</h3>';

$pdo = getPdoConnection();

try {
    $pdo->beginTransaction();

    //Haetaan valikkoon lista valmistajista
    $sql = "SELECT DISTINCT valmistaja FROM konsolitunniste ORDER BY valmistaja asc";

    $pvalmistaja = $pdo->query($sql);

    $pdo->commit();

    if ($pvalmistaja->rowCount() > 0) {
        echo '<div class="drop"><label for="valmistaja" id="vlabel" value="valmistaja"  class="col-md-0" col-form-label">Pelit valmistajittain:</label>
        <select name="valmistaja">';

        foreach ($pvalmistaja as $row) {
            echo '<option value="' . $row["valmistaja"] . '">' . $row["valmistaja"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select></div>';
    }
} catch (\Throwable $pdoex) {
    $pdo->rollback();
    throw $pdoex;
}

try {
    $pdo->beginTransaction();

    //Haetaan valikkoon lista konsoleista
    $sql = "SELECT DISTINCT malli FROM konsolitunniste WHERE malli NOT LIKE '%Hero%' AND malli NOT LIKE '%Groud%' AND malli NOT LIKE '%Micro%' AND malli NOT LIKE '%One%' ORDER BY malli asc";

    $pmalli = $pdo->query($sql);

    $pdo->commit();

    if ($pmalli->rowCount() > 0) {
        echo '<div class="drop"><label for="malli" id="mlabel" value="malli" class="col-md-0" col-form-label">Pelit konsoleittain:</label>
        <select name="malli">';

        foreach ($pmalli as $row) {
            echo '<option value="' . $row["malli"] . '">' . $row["malli"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select></div>';
    }
} catch (\Throwable $pdoex) {
    $pdo->rollback();
    throw $pdoex;
}

try {
    $pdo->beginTransaction();

    //Haetaan valikkoon tyylilajit
    $sql = "SELECT DISTINCT tyylilaji FROM genre ORDER BY tyylilaji asc";

    $genre = $pdo->query($sql);

    $pdo->commit();

    if ($genre->rowCount() > 0) {
        echo '<div class="drop"><label for="tyylilaji" id="tlabel" value="tyylilaji" class="col-md-0" col-form-label">Pelit tyylilajeittain:</label>
        <select name="tyylilaji">';

        foreach ($genre as $row) {
            echo '<option value="' . $row["tyylilaji"] . '">' . $row["tyylilaji"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select></div>';
    }
} catch (\Throwable $pdoex) {
    $pdo->rollback();
    throw $pdoex;
}

try {
    $pdo->beginTransaction();

    //Haetaan valikkoon lista valmistajista
    $sql = "SELECT DISTINCT valmistaja FROM konsolitunniste WHERE malli NOT LIKE '%PC%' ORDER BY valmistaja asc";

    $pkonsoli = $pdo->query($sql);

    $pdo->commit();

    if ($pkonsoli->rowCount() > 0) {
        echo '<div class="drop"><label for="konsoli" id="klabel" value="konsoli" class="col-md-1" col-form-label">Konsolit:</label>
        <select name="konsoli">';

        foreach ($pkonsoli as $row) {
            echo '<option value="' . $row["valmistaja"] . '">' . $row["valmistaja"] . '</option>';
        }
        echo '<option value="Pelikonsoli">Pelikonsolit</option>
        <option value="Käsikonsoli">Käsikonsolit</option>
        <option value="Kaikki">Kaikki</option>
        <option value="Valitse" selected="selected">Valitse</option>
        </select></div>';
    }
} catch (\Throwable $pdoex) {
    $pdo->rollback();
    throw $pdoex;
}

echo '<div class="drop"><label for="nimihaku" id="hlabel" value="nimihaku" class="col-md-1" col-form-label">Nimihaku:</label><input type ="text" name="nimihaku"/>';

echo '<div class="hae_nappi"><input type="submit" name="Hae" class="btn btn-primary" value="Hae"/></div>';

echo '</form></div>';

if (isset($nimihaku) && ($valmistaja === 'Valitse') && ($malli === 'Valitse') && ($tyylilaji === 'Valitse') && ($konsoli === 'Valitse')) {

    $result = getPelitNimi($nimihaku);

    echo '<div class="table"><table class=gridtable><thead><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr></thead>';
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tbody><tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . str_replace(",", " / ", $row["tyylilaji"]) . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr></tbody>";
    }
    echo "</table></div>";
    return $result;
}

if (isset($valmistaja) && ($tyylilaji === 'Valitse') && ($konsoli === 'Valitse') && ($malli === 'Valitse')) {

    $result = getPelitV($valmistaja);

    echo '<div class="table"><table class=gridtable><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>';
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . str_replace(",", " / ", $row["tyylilaji"]) . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table></div";
    return $result;
}

if (isset($malli) && ($tyylilaji === 'Valitse') && ($konsoli === 'Valitse') && ($valmistaja === 'Valitse')) {

    $result = getPelitM($malli);

    echo '<div class="table"><table class=gridtable><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>';
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . str_replace(",", " / ", $row["tyylilaji"]) . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table></div>";
    return $result;
}

if (isset($tyylilaji) && ($malli === 'Valitse') && ($konsoli === 'Valitse') && ($valmistaja === 'Valitse')) {

    $result = getPelitT($tyylilaji);

    echo '<div class="table"><table class=gridtable><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>';
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . str_replace(",", " / ", $row["tyylilaji"]) . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table></div>";
    return $result;
}

if (isset($valmistaja) && (isset($tyylilaji)) && ($konsoli === 'Valitse') && ($malli === 'Valitse')) {

    $result = getPelitVt($valmistaja, $tyylilaji);

    echo '<div class="table"><table class=gridtable><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>';
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . str_replace(",", " / ", $row["tyylilaji"]) . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table></div>";
    return $result;
}

if (isset($malli) && (isset($tyylilaji)) && ($konsoli === 'Valitse') && ($valmistaja === 'Valitse')) {

    $result = getPelitMt($malli, $tyylilaji);

    echo '<div class="table"><table class=gridtable><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>';
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . str_replace(",", " / ", $row["tyylilaji"]) . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table></div>";
    return $result;
}

if (isset($konsoli) && ($valmistaja === 'Valitse') && ($malli === 'Valitse') && ($tyylilaji === 'Valitse')) {

    $result = getKonsolit($konsoli);

    echo '<div class="table"><table class=gridtable><tr><th>Valmistaja</th><th>Malli</th><th>kpl</th><th>Väri</th><th>Konsolityyppi</th></tr>';
    foreach ($result as $row) {
        echo "<tr><td>" . $row['valmistaja'] . "</td>";
        echo "<td>" . $row['malli'] . "</td>";
        echo "<td>" . $row['kpl'] . "</td>";
        echo "<td>" . $row['vari'] . "</td>";
        echo "<td>" . $row['konsolityyppi'] . "</td>";
        echo "</tr>";
    }
    echo "</table></div>";
    return $result;
}

echo '</div>';
include TEMPLATES_DIR . 'footer.php';
?>