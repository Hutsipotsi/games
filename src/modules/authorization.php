<?php
function login($uname, $pass){

    require_once './db.php';

    //Tarkistetaan onko muttujia asetettu
    if( !isset($uname) || !isset($pass) ){
        throw new Exception("Missing parameters. Cannot log in.");
    }

    //Tarkistetaan, ettei tyhjiä arvoja muuttujissa
    if( empty($uname) || empty($pass) ){
        throw new Exception("Cannot log in with empty values.");
    }

    try{
        $pdo = getPdoConnection();
        //Haetaan käyttäjä annetulla käyttäjänimellä
        $sql = "SELECT * FROM istunto_kayttaja WHERE tunnus=?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $uname);
        //$statement->bindParam(2, $oikat);
        $statement->execute();

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
