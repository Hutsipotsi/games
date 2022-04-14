<?php

function addGame($pelin_nimi, $tyylilajit, $ikasuositus, $konsolitunniste) {
    require_once MODULES_DIR . 'db.php';

    if (!isset($pelin_nimi) || !isset($tyylilajit) || !isset($ikasuositus) || !isset($konsolitunniste)) {
        echo "Missing parameters: Game not saved.";
        exit;
    }

    $pdo = getPdoConnection();

    try {
        $pdo->beginTransaction();

        $sql = "INSERT INTO peli (nimi, ikasuositus, konsolitunniste) VALUES (?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $pelin_nimi);
        $statement->bindParam(2, $ikasuositus);
        $statement->bindParam(3, $konsolitunniste);
        $statement->execute();

        $peli_id = $pdo->lastInsertId();

        foreach($tyylilajit as $tyylilaji) {
            $sql = "INSERT INTO yhdistelmagenre (genre_id, peli_id) VALUES (?, ?)";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $tyylilaji);
            $statement->bindParam(2, $peli_id);
            $statement->execute();
        }
        $pdo->commit();
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }

    /*require_once MODULES_DIR.'db.php'; // DB connection

    //Tarkistetaan onko parametreja asetettu
    if( !isset($personID) || !isset($startTime) || !isset($endTime) ){
        echo "Parametreja puuttui!! Ei voida lisätä työaikaa";
        exit;
    }

    //Tarkistetaan, ettei tyhjiä arvoja muuttujissa
    if( empty($startTime) || empty($endTime) ){
        echo "Et voi asettaa tyhjiä arvoja!!";
        exit;
    }

    try{
        $pdo = getPdoConnection();
        //Suoritetaan parametrien lisääminen tietokantaan.
        $sql = "INSERT INTO worktime (person_id, start_time, end_time, task_description) VALUES (?,?,?,?)";
        $statement = $pdo->prepare($sql);
        $statement->execute( array($personID, $startTime, $endTime, $taskDescription) );

        echo "Worktime logged<br><br>";
    }catch(PDOException $e){
        echo "Unable to add worktime";
        echo $e->getMessage();
    }*/
}
