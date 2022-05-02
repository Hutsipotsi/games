<?php

require_once MODULES_DIR . 'db.php';

/**
 * Fetches all the game genres that are stored in 'genre' table of the database.
 * 
 * @return array genre IDs
 */
function getGenres()
{

    try {
        $pdo = getPdoConnection();

        $sql = "SELECT * FROM genre ORDER BY tyylilaji asc";
        $genres = $pdo->query($sql);

        return $genres->fetchAll();
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Fetches all the game consoles that are stored in 'konsolitunniste' table of the database.
 * 
 * @return array console IDs
 */
function getConsoleIDs()
{
    try {
        $pdo = getPdoConnection();

        $sql = "SELECT * FROM konsolitunniste WHERE malli NOT LIKE '%Hero%' AND malli NOT LIKE '%Groud%' AND malli NOT LIKE '%Micro%' AND malli NOT LIKE '%One%' ORDER BY malli asc";
        $consoleIDs = $pdo->query($sql);

        return $consoleIDs->fetchAll();
    } catch (PDOException $e) {
        throw $e;
    }
}

// EOF