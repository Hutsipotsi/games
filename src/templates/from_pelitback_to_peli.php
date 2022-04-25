<?php

require '../src/modules/db.php';

$pdo = getPdoConnection();

$sql = "SELECT * FROM pelitback";
$pelitback = $pdo->query($sql);

$pelin_nimi;
$tyylilaji = array();
$ikasuositus;
$konsolitunniste;

if($pelitback->rowCount() > 0) {
    try {
        $pdo->beginTransaction();
        while ($row = $pelitback->fetch()) {
            $pelin_nimi = $row["pelin_nimi"];
            $tyylilaji = explode(" / ", $row["tyylilaji"]);
            $ikasuositus = $row["ikasuositus"];
            $konsolitunniste = $row["tunniste"];

            $sql = "INSERT INTO peli (nimi, ikasuositus, konsolitunniste) VALUES (?, ?, ?)";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $pelin_nimi);
            $statement->bindParam(2, $ikasuositus);
            $statement->bindParam(3, $konsolitunniste);
            $statement->execute();

            echo $pelin_nimi . " ";

            $peli_id = $pdo->lastInsertId();

            for($i = 0; $i < count($tyylilaji); $i++) {
                $sql = "INSERT INTO yhdistelmagenre (genre_id, peli_id) VALUES (?, ?)";
                $statement = $pdo->prepare($sql);
                $statement->bindParam(1, $tyylilaji[$i]);
                $statement->bindParam(2, $peli_id);
                $statement->execute();
                echo " " . $tyylilaji[$i];
            }
            echo "<br>";
        }
        $pdo->commit();
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }
}