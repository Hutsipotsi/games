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

function addPerson($uname, $pw, $email, $oikat){
    require_once 'db.php'; // DB connection

    //Tarkistetaan onko muttujia asetettu
    if( !isset($uname) || !isset($pw) || !isset($email) || !isset($oikat) ){
        echo "Parametreja puuttui!! Ei voida lisätä henkilöä";
        exit;
    }

    //Tarkistetaan, ettei tyhjiä arvoja muuttujissa
    if( empty($uname) || empty($pw) || empty($email) || empty($oikat) ){
        echo "Et voi asettaa tyhjiä arvoja!!";
        exit;
    }

    try{
        $pdo = getPdoConnection();
        //Suoritetaan parametrien lisääminen tietokantaan.
        $sql = "INSERT INTO istunto_kayttaja (tunnus, password, email, admin) VALUES (?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $uname);
        $statement->bindParam(2, $email);
        $statement->bindParam(3, $oikat);

        $hash_pw = password_hash($pw, PASSWORD_DEFAULT);
        $statement->bindParam(4, $hash_pw);

        $statement->execute();

        echo "Tervetuloa ".$uname." . Sinut on lisätty tietokantaan"; 
    }catch(PDOException $e){
        echo "Käyttäjää ei voitu lisätä<br>";
        echo $e->getMessage();
    }
}