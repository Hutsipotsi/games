<?php

function getKonsoliKaikki(){
    require_once MODULES_DIR.'db.php';

    try{
        $pdo = getPdoConnection();
        // Create SQL query to get all rows from a table
        $sql = "SELECT valmistaja, malli, kpl, vari FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND valmistaja=?";
        // Execute the query
        $konsolit = $pdo->query($sql);

        return $konsolit->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
}

?>