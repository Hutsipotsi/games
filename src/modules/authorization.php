<?php
function login($uname, $pass){

    require_once './db.php';

    //Tarkistetaan onko muttujia asetettu
    if( !isset($uname) || !isset($pass) ){
        throw new Exception("Pakollisia tietoja puuttuu, ei voi kirjautua.");
    }

    //Tarkistetaan, ettei tyhjiä arvoja muuttujissa
    if( empty($uname) || empty($pass) ){
        throw new Exception("Kirjautumistiedot eivät voi olla tyhjät.");
    }

    $pdo = getPdoConnection();

    try{
        $pdo->beginTransaction();

        //Haetaan käyttäjä annetulla käyttäjänimellä
        $sql = "SELECT tunnus, email, oikat, password FROM istunto_kayttaja WHERE tunnus=?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $uname);
        $statement->execute();
        $pdo->commit();
        
        if($statement->rowCount() <=0){
            throw new Exception("Käyttäjää ei löytynyt!");
        }

        $row = $statement->fetch();

        //Tarkistetaan käyttäjän antama salasana tietokannan salasanaa vasten
        if(!password_verify($pass, $row["password"] )){
            throw new Exception("Väärä salasana!!");
        }

        //Jos käyttäjä tunnistettu, talletetaan käyttäjän tiedot sessioon
        $_SESSION["tunnus"] = $uname; 
       //$_SESSION["oikat"] = $oikat;
    }catch(PDOException $e){
        $pdo->rollback();
        throw $e;
    }

}

function logout(){
    //Tyhjennetään ja tuhotaan nykyinen sessio.
    try{
        session_unset();
        session_destroy();
    }catch(Exception $e){
        throw $e;
    }
}
