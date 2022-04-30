<?php
include MODULES_DIR . 'db.php';
include TEMPLATES_DIR . 'header.php';
include TEMPLATES_DIR . 'konsolihaku.php';
include TEMPLATES_DIR . 'nimihaku.php';
include TEMPLATES_DIR . 'pelihaku.php';

$nimihaku = filter_input(INPUT_POST, "nimihaku", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$tyylilaji = filter_input(INPUT_POST, "tyylilaji", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$valmistaja = filter_input(INPUT_POST, "valmistaja", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$malli = filter_input(INPUT_POST, "malli", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$konsoli = filter_input(INPUT_POST, "konsoli", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$kasikonsoli = filter_input(INPUT_POST, "käsikonsoli", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pelikonsoli = filter_input(INPUT_POST, "pelikonsoli", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$konsolitkaikki = filter_input(INPUT_POST, "kaikki", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

echo '<container><form action="pelitesti.php" method="post">';

$pdo = getPdoConnection();

//Haetaan valikkoon lista valmistajista
$sql = "SELECT DISTINCT valmistaja FROM konsolitunniste ORDER BY valmistaja asc";

$pvalmistaja = $pdo->query($sql);


if ($pvalmistaja->rowCount() > 0) {
    echo '<label for="valmistaja" value="valmistaja" class="col-sm-2 col-form-label">Pelit valmistajittain:</label>
        <select name="valmistaja">';

    foreach ($pvalmistaja as $row) {
        echo '<option value="' . $row["valmistaja"] . '">' . $row["valmistaja"] . '</option>';
    }
    echo '<option value="Valitse" selected="selected">Valitse</option></select>';
}

//Haetaan valikkoon lista konsoleista
$sql = "SELECT DISTINCT malli FROM konsolitunniste WHERE malli NOT LIKE '%Hero%' AND malli NOT LIKE '%Groud%' AND malli NOT LIKE '%Micro%' AND malli NOT LIKE '%One%' ORDER BY malli asc";

$pmalli = $pdo->query($sql);

if ($pmalli->rowCount() > 0) {
    echo '<label for="malli" value="malli"class="col-sm-2 col-form-label">Pelit konsoleittain:</label>
        <select name="malli">';

    foreach ($pmalli as $row) {
        echo '<option value="' . $row["malli"] . '">' . $row["malli"] . '</option>';
    }
    echo '<option value="Valitse" selected="selected">Valitse</option></select>';
}

//Haetaan valikkoon tyylilajit
$sql = "SELECT DISTINCT tyylilaji FROM genre ORDER BY tyylilaji asc";

$genre = $pdo->query($sql);

if ($genre->rowCount() > 0) {
    echo '<label for="tyylilaji" value="tyylilaji" class="col-sm-2 col-form-label">Pelit tyylilajeittain:</label>
        <select name="tyylilaji">';

    foreach ($genre as $row) {
        echo '<option value="' . $row["tyylilaji"] . '">' . $row["tyylilaji"] . '</option>';
    }
    echo '<option value="Valitse" selected="selected">Valitse</option></select>';
}

//Haetaan valikkoon lista valmistajista
$sql = "SELECT DISTINCT valmistaja FROM konsolitunniste WHERE malli NOT LIKE '%PC%' ORDER BY valmistaja asc";

$pkonsoli = $pdo->query($sql);

if ($pkonsoli->rowCount() > 0) {
    echo '<label for="konsoli" value="konsoli" class="col-sm-2 col-form-label">Konsolit:</label>
        <select name="konsoli">';

    foreach ($pkonsoli as $row) {
        echo '<option value="' . $row["valmistaja"] . '">' . $row["valmistaja"] . '</option>';
    }
    echo '<option value="pelikonsoli">Pelikonsoli</option><option value="kasikonsoli">Käsikonsoli</option><option value="konsoli">Kaikki</option><option value="Valitse" selected="selected">Valitse</option></select>';
}

echo '<label for="nimihaku" value="nimihaku" class="col-sm-2 col-form-label">Nimihaku:</label><input type ="text" name="nimihaku"/>';

echo '<div class="col-sm-2 "><input type="submit" name="Hae" value="Hae"/></div>';

echo '</form>';



if (isset($valmistaja) && ($tyylilaji==='Valitse') && ($konsoli==='Valitse') && ($malli==='Valitse')) {

    $result = getPelitV($valmistaja);

    echo '<table class=table-bordered><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>';
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . $row["tyylilaji"] . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table>";
}


if (isset($malli) && ($tyylilaji==='Valitse') && ($konsoli==='Valitse') && ($valmistaja==='Valitse')) {

$result = getPelitM($malli);

echo "<table class=table-bordered><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>";
//Luodaan yksi taulukon rivi tietokannan rivistä
foreach ($result as $row) {
    echo "<tr><td>" . $row["nimi"] . "</td>";
    echo "<td>" . $row["tyylilaji"] . "</td>";
    echo "<td>" . $row["ikasuositus"] . "</td>";
    echo "<td>" . $row["malli"] . "</td></tr>";
}
echo "</table>";
}



if (isset($tyylilaji) && ($malli==='Valitse') && ($konsoli==='Valitse') && ($valmistaja==='Valitse')) {

    $result = getPelitT($tyylilaji);

    echo "<table class=table-bordered><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>";
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . $row["tyylilaji"] . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table>";
}


if (isset($valmistaja) && (isset($tyylilaji)) && ($konsoli==='Valitse') && ($malli==='Valitse')) {

    $result = getPelitVt($valmistaja, $tyylilaji);

    echo "<table class=table-bordered><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>";
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . $row["tyylilaji"] . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table>";
}

if (isset($malli) && (isset($tyylilaji)) && ($konsoli==='Valitse') && ($valmistaja==='Valitse')) {

    $result = getPelitMt($malli, $tyylilaji);

    echo "<table class=table-bordered><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>";
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . $row["tyylilaji"] . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table>";
}

if(isset($konsoli) && ($valmistaja==='Valitse') && ($malli==='Valitse') && ($tyylilaji==='Valitse')) {

    $result = getKonsolit($konsoli);

    echo "<table class=table-bordered><tr><th>Valmistaja</th><th>Malli</th><th>kpl</th><th>Väri</th></tr>";
    foreach($result as $row) {
    echo "<tr><td>".$row['valmistaja']."</td>";
    echo "<td>".$row['malli']."</td>";
    echo "<td>".$row['kpl']."</td>";
    echo "<td>".$row['vari']."</td>";
    echo "</tr>";
    }
    echo "</table>";
}

if(isset($kasikonsoli) || (isset($pelikonsoli) && ($valmistaja==='Valitse') && ($malli==='Valitse') && ($tyylilaji==='Valitse'))) {

    $result = getKonsolitKp($kasikonsoli);
    
    echo "<table class=table-bordered><tr><th>Valmistaja</th><th>Malli</th><th>kpl</th><th>Väri</th></tr>";
    foreach($result as $row) {
    echo "<tr><td>".$row['valmistaja']."</td>";
    echo "<td>".$row['malli']."</td>";
    echo "<td>".$row['kpl']."</td>";
    echo "<td>".$row['vari']."</td>";
    echo "</tr>";
    }
    echo "</table>";
    }
    
    
    if($_POST($konsolitkaikki) && ($valmistaja==='Valitse') && ($malli==='Valitse') && ($tyylilaji==='Valitse') && ($konsoli==='Kaikki')) {
    
    $result = getKonsolitK();
    
    echo "<table class=table-bordered><tr><th>Valmistaja</th><th>Malli</th><th>kpl</th><th>Väri</th></tr>";
    foreach($result as $row) {
    echo "<tr><td>".$row['valmistaja']."</td>";
    echo "<td>".$row['malli']."</td>";
    echo "<td>".$row['kpl']."</td>";
    echo "<td>".$row['vari']."</td>";
    echo "</tr>";
    }
    echo "</table>";
    }


if (isset($nimihaku)){

    $result = getPelitNimi($nimihaku);

    echo "<table class=table-bordered><tr><th>Pelin nimi</th><th>tyylilaji</th><th>Ikäsuositus</th><th>Konsoli</th></tr>";
    //Luodaan yksi taulukon rivi tietokannan rivistä
    foreach ($result as $row) {
        echo "<tr><td>" . $row["nimi"] . "</td>";
        echo "<td>" . $row["tyylilaji"] . "</td>";
        echo "<td>" . $row["ikasuositus"] . "</td>";
        echo "<td>" . $row["malli"] . "</td></tr>";
    }
    echo "</table>";
}
echo '</container>';
?>