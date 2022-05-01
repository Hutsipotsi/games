<?php
/*

function getKonsolitK(){
    require_once MODULES_DIR.'db.php';

    $pdo = getPdoConnection();

    try {
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste";
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    catch(\Throwable $pdoex) {
    throw $pdoex;
}
}
function getKonsolitKp($kasikonsoli){
    require_once MODULES_DIR.'db.php';

    $pdo = getPdoConnection();

    try {
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND konsolityyppi = '$kasikonsoli'";
    
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    catch(\Throwable $pdoex) {
    throw $pdoex;
}
}*/

function getKonsolit($konsoli){
    require_once MODULES_DIR.'db.php';

    $pdo = getPdoConnection();

    try {

    if($konsoli==='Kaikki') {
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste";
    }
    elseif(($konsoli==='Pelikonsoli') || ($konsoli==='Käsikonsoli')) {
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND konsolityyppi = '$konsoli'";
    }
    else {
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND valmistaja='$konsoli'";   
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

?>


<?php
/*
function getKonsolit($konsoli){
    require_once MODULES_DIR.'db.php';

    $pdo = getPdoConnection();

    try {
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND valmistaja='$konsoli'";
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    catch(\Throwable $pdoex) {
        throw $pdoex;
    }
}*/
?>