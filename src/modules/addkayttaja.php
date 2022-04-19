<?php

function getPeople(){
    require_once 'db.php';

    try {
        $pdo = getPdoConnection();
        // Create SQL query to get all rows from a table
        $sql = "SELECT * FROM istunto_kayttaja";
        // Execute the query
        $people = $pdo->query($sql);

        return $people->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
}

function addPerson($uname, $email, $oikat, $pw){
    require_once 'db.php'; // DB connection

    //Tarkistetaan onko muttujia asetettu
    if( !isset($uname) || !isset($email) || !isset($oikat) || !isset($pw) ){
        echo "Parametreja puuttui!! Ei voida lisätä henkilöä";
        exit;
    }

    //Tarkistetaan, ettei tyhjiä arvoja muuttujissa
    if( empty($uname) || empty($email) || empty($oikat) || empty($pw) ){
        echo "Et voi asettaa tyhjiä arvoja!!";
        exit;
    }

    //Tarkistetaan, onko oikeuksia lisätä käyttäjiä
    if( $oikat > 1) {
        echo "Sinulla ei ole oikeuksia lisätä käyttäjiä!!";
        exit;
    }

    $pdo = getPdoConnection();

    try{
        $pdo->beginTransaction();

        //Suoritetaan parametrien lisääminen tietokantaan.
        $sql = "INSERT INTO istunto_kayttaja (tunnus, email, oikat, password) VALUES (?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $uname);
        $statement->bindParam(2, $email);
        $statement->bindParam(3, $oikat);

        $hash_pw = password_hash($pw, PASSWORD_DEFAULT);
        $statement->bindParam(4, $hash_pw);

        $statement->execute();

        echo "Tervetuloa ".$uname." . Sinut on lisätty tietokantaan"; 
        $pdo->commit();
    }catch(PDOException $e){
        $pdo->rollback();
        echo "Käyttäjää ei voitu lisätä<br>";
        echo $e->getMessage();
    }
}