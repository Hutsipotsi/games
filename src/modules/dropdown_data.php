<?php

require_once MODULES_DIR.'db.php';

function getGenres() {

    try{
        $pdo = getPdoConnection();

        $sql = "SELECT * FROM genre ORDER BY tyylilaji asc";
        $genres = $pdo->query($sql);

        return $genres->fetchAll();

    }catch(PDOException $e){
        throw $e;
    }
}

function getConsoleIDs() {
    try{
        $pdo = getPdoConnection();

        $sql = "SELECT * FROM konsolitunniste WHERE malli NOT LIKE '%Hero%' AND malli NOT LIKE '%Groud%' AND malli NOT LIKE '%Micro%' AND malli NOT LIKE '%One%' ORDER BY malli asc";
        $consoleIDs = $pdo->query($sql);

        return $consoleIDs->fetchAll();

    }catch(PDOException $e){
        throw $e;
    }
}

?>