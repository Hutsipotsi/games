<?php

$uname = filter_input(INPUT_POST, "tunnus");
$email = filter_input(INPUT_POST, "email");
$oikat = filter_input(INPUT_POST, "oikat");
$pw = filter_input(INPUT_POST, "password");
$tallenna = filter_input(INPUT_POST, "tallenna");
$poista = filter_input(INPUT_POST, "poista");


function getPeople(){
    require_once MODULES_DIR . 'db.php';

    try {
        $pdo = getPdoConnection();

        $pdo->beginTransaction();
        // Create SQL query to get all rows from a table
        $sql = "SELECT * FROM istunto_kayttaja";
        // Execute the query
        $people = $pdo->query($sql);
        $pdo->commit();
        return $people->fetchAll();
       
    }catch(PDOException $e){
        $pdo->rollBack();
        throw $e;
    }
}

if(array_key_exists('tallenna', $_POST)) {
    addPerson($uname, $email, $oikat, $pw);
}
else if(array_key_exists('poista', $_POST)) {
    deletePerson($uname);
}

function addPerson($uname, $email, $oikat, $pw){
    require_once MODULES_DIR . 'db.php'; // DB connection

    if ($_SESSION['oikat']!="1") {
        echo '<div class="alert alert-danger" role="alert">Sinulla ei ole oikeuksia lisätä käyttäjiä!!</di>';
        exit;
    }

    //Tarkistetaan onko muttujia asetettu
    if( !isset($uname) || !isset($email) || !isset($oikat) || !isset($pw) ){
        echo '<div class="alert alert-danger" role="alert">Tietoja puuttui. Täytä kaikki kentät!! Ei voida lisätä henkilöä</div>';
        exit;
    }

    //Tarkistetaan, ettei tyhjiä arvoja muuttujissa
    if( empty($uname) || empty($email) || $oikat === 'Valitse oikeustaso' || empty($pw) ){
        echo '<div class="alert alert-danger" role="alert">Et voi asettaa tyhjiä arvoja!!</div>';
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
        $pdo->commit();
        echo '<div class="alert alert-success" role="alert">Käyttäjä ' .$uname. ' lisätty!!</div>';
        
    }catch(PDOException $e){
        $pdo->rollback();
        echo "Käyttäjää ei voitu lisätä<br>";
        echo $e->getMessage();
    }
}

function deletePerson($uname){
    require_once MODULES_DIR.'db.php'; // DB connection
    
    if ($_SESSION['oikat']!="1") {
        echo '<div class="alert alert-danger" role="alert">Sinulla ei ole oikeutta poistaa käyttäjiä!!</div>';
        exit;
    }
    //Tarkistetaan onko muttujia asetettu
    if($_POST=== 'tallenna' || empty($uname) ){
        echo '<div class="alert alert-danger" role="alert">Käyttäjätunnus puuttuu! Henkilöä ei voi poistaa!</div>';
        exit;
    }
    
    try{
        $pdo = getPdoConnection();
        // Start transaction
        $pdo->beginTransaction();
        // Delete from istunto_kayttaja table
        $sql = "DELETE FROM istunto_kayttaja WHERE tunnus = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $uname);        
        $statement->execute();
        // Commit transaction
        $pdo->commit();
        echo '<div class="alert alert-success" role="alert">Käyttäjä ' .$uname. ' poistettu!!</div>';

    }catch(PDOException $e){
        // Rollback transaction on error
        $pdo->rollBack();
        throw $e;
    }
}
