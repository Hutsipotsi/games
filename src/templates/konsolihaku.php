<?php

function getKonsoleittain($konsoli){
    require_once MODULES_DIR.'db.php';
    
    $pdo = getPdoConnection();

    try {
        if($_POST==='kaikki') {
        //Haetaan kaikki konsolit
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste;";
    }
    else {
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND valmistaja='$konsoli';";
    }
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    catch(\Throwable $pdoex) {
        throw $pdoex;
}
}

function getKonsolit($konsoli){
    require_once MODULES_DIR.'db.php';
    
    $pdo = getPdoConnection();
    
    try {
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND konsolityyppi = '$konsoli';";
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    catch(\Throwable $pdoex) {
        throw $pdoex;
}
}
?>