<?php

/**
 * Inserts a new game title into the database with given parameters.
 * 
 * Genres are inserted into 'yhdistelmagenre' table while rest go into 'peli'.
 * 
 * @param string $pelinnimi the game's name
 * @param array [ int ] $tyylilajit the game's genres
 * @param int $ikasuositus the game's age rating
 * @param int $konsolitunniste the gaming console the game is for
 */
function addGame($pelin_nimi, $tyylilajit, $ikasuositus, $konsolitunniste)
{
    require_once MODULES_DIR . 'db.php';

    if ($_SESSION['oikat']>"2") {
        echo '<div class="alert alert-danger" role="alert">Sinulla ei ole oikeuksia lisätä pelejä!!</di>';
        exit;
    }
    if (!isset($pelin_nimi) || !isset($tyylilajit) || !isset($ikasuositus) || !isset($konsolitunniste)) {
        echo "Tietoja puuttuu: Peliä ei tallennettu.";
        exit;
    }

    $pdo = getPdoConnection();

    try {
        $pdo->beginTransaction();

        $sql = "INSERT INTO peli (nimi, ikasuositus, konsolitunniste) VALUES (?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $pelin_nimi);
        $statement->bindParam(2, $ikasuositus);
        $statement->bindParam(3, $konsolitunniste);
        $statement->execute();

        $peli_id = $pdo->lastInsertId();

        foreach ($tyylilajit as $tyylilaji) {
            $sql = "INSERT INTO yhdistelmagenre (genre_id, peli_id) VALUES (?, ?)";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $tyylilaji);
            $statement->bindParam(2, $peli_id);
            $statement->execute();
        }
        $pdo->commit();
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }
}

/**
 * Updates a game's data in the database with given parameters.
 * 
 * @param int $pelin_id the game's primary key in the database
 * @param string $pelin_nimi the game's name
 * @param array [ int ] $tyylilajit the game's genres
 * @param int $konsolitunniste the gaming console the game is for
 */
function updateGame($pelin_id, $pelin_nimi, $tyylilajit, $ikasuositus, $konsolitunniste)
{
    require_once MODULES_DIR . 'db.php';

    if ($_SESSION['oikat']>"2") {
        echo '<div class="alert alert-danger" role="alert">Sinulla ei ole oikeuksia muokata pelejä!!</di>';
        exit;
    }

    if (!isset($pelin_nimi) || !isset($tyylilajit) || !isset($ikasuositus) || !isset($konsolitunniste)) {
        echo "Tietoja puuttuu: Pelin tietoja ei muutettu.";
        exit;
    }

    $pdo = getPdoConnection();

    try {
        $pdo->beginTransaction();

        $sql = "UPDATE peli
            SET nimi = ?, ikasuositus = ?, konsolitunniste = ?
            WHERE id = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $pelin_nimi);
        $statement->bindParam(2, $ikasuositus);
        $statement->bindParam(3, $konsolitunniste);
        $statement->bindParam(4, $pelin_id);
        $statement->execute();

        $sql = "DELETE FROM yhdistelmagenre
            WHERE peli_id = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $pelin_id);
        $statement->execute();

        foreach ($tyylilajit as $tyylilaji) {
            $sql = "INSERT INTO yhdistelmagenre (genre_id, peli_id) VALUES (?, ?)";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $tyylilaji);
            $statement->bindParam(2, $pelin_id);
            $statement->execute();
        }
        $pdo->commit();
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }
}

/**
 * Deletes from the database a game that matches the parameter.
 * 
 * The game's genres are deleted from 'yhdistelmagenre' junction table
 * and the game from 'peli' table.
 * 
 * @param int $pelin_id the game's primary key in the database
 */
function removeGame($pelin_id)
{
    require_once MODULES_DIR . 'db.php';

    if ($_SESSION['oikat']!="1") {
        echo '<div class="alert alert-danger" role="alert">Sinulla ei ole oikeuksia lisätä pelejä!!</di>';
        exit;
    }
    $pdo = getPdoConnection();

    try {
        $pdo->beginTransaction();

        $sql = "DELETE FROM yhdistelmagenre
            WHERE peli_id = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $pelin_id);
        $statement->execute();

        $sql = "DELETE FROM peli
            WHERE id = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $pelin_id);
        $statement->execute();

        $pdo->commit();
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }
}

/**
 * Finds all games in the database that match the search string (as per SQL's LIKE)
 * and prints their data on the page.
 * 
 * @param string $pnimi the search term
 */
function searchByName($pnimi)
{
    require_once MODULES_DIR . 'db.php';

    $pdo = getPdoConnection();
    try {
        $pdo->beginTransaction();

        $sql = "SELECT peli.id, peli.nimi, peli.ikasuositus, konsolitunniste.malli, group_concat(genre.tyylilaji) as genret
            FROM peli
            INNER JOIN konsolitunniste
            ON peli.konsolitunniste = konsolitunniste.id
            INNER JOIN yhdistelmagenre
            ON peli.id = yhdistelmagenre.peli_id
            INNER JOIN genre
            ON yhdistelmagenre.genre_id = genre.id
            WHERE peli.nimi LIKE '%$pnimi%'
            GROUP BY peli.id";

        $results = $pdo->query($sql);
        $pelit = $results->fetchAll();
        $pdo->commit();
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }

    echo '<form action="lisaapeli.php" method="post">';
    echo '<table class=table-bordered>
    <tr>
    <th>Pelin nimi</th>
    <th>tyylilaji</th>
    <th>Ikäsuositus</th>
    <th>Konsoli</th>
    <th></th>
    </tr>';
    foreach ($pelit as $row) {
        echo '<tr><td>' . $row["nimi"] . '</td>';
        echo '<td>' . $row["genret"] . '</td>';
        echo '<td>' . $row["ikasuositus"] . '</td>';
        echo '<td>' . $row["malli"] . '</td>';
        echo '<td><button type="submit" name="edit" value="' . $row['id'] . '" ' . 'class="btn btn-primary" >Päivitä</button></td>';
    }
    echo '</table>';
    echo '</form>';
}

/**
 * Fetches a game's name from the database.
 * 
 * @param int $pelin_id the game's primary key in the database
 * @return string the game's name
 */
function fetchGameName($pelin_id)
{
    require_once MODULES_DIR . 'db.php';

    $pdo = getPdoConnection();

    try {
        $pdo->beginTransaction();
        $sql = "SELECT peli.nimi
            FROM peli
            WHERE peli.id = $pelin_id";

        $game = $pdo->query($sql)->fetch();
        $pdo->commit();

        return $game['nimi'];
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }
}

/**
 * Fetches a game's genres from the database.
 * 
 * @param int $pelin_id the game's primary key in the database
 * @return array [ int ] the game's genres as their primary keys in 'genre' table
 */
function fetchGenres($pelin_id)
{
    require_once MODULES_DIR . 'db.php';

    $pdo = getPdoConnection();

    try {
        $pdo->beginTransaction();
        $sql = "SELECT yhdistelmagenre.genre_id
            FROM yhdistelmagenre
            WHERE yhdistelmagenre.peli_id = $pelin_id";

        $results = $pdo->query($sql)->fetchAll();
        $genres = array();
        foreach ($results as $row) {
            array_push($genres, $row['genre_id']);
        }
        $pdo->commit();

        return $genres;
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }
}

/**
 * Fetches a game's age rating from the database.
 * 
 * @param int $pelin_id the game's primary key in the database
 * @return int the game's age rating
 */
function fetchAgeRating($pelin_id)
{
    require_once MODULES_DIR . 'db.php';

    $pdo = getPdoConnection();

    try {
        $pdo->beginTransaction();

        $sql = "SELECT peli.ikasuositus
            FROM peli
            WHERE peli.id = $pelin_id";

        $game = $pdo->query($sql)->fetch();
        $pdo->commit();

        return $game['ikasuositus'];
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }
}

/**
 * Fetches a game's console from the database.
 * 
 * @param int $pelin_id the game's primary key in the database
 * @return int the game's console as 
 */
function fetchConsoleID($pelin_id)
{
    require_once MODULES_DIR . 'db.php';

    $pdo = getPdoConnection();

    try {
        $pdo->beginTransaction();
        $sql = "SELECT peli.konsolitunniste
            FROM peli
            WHERE peli.id = $pelin_id";

        $game = $pdo->query($sql)->fetch();
        $pdo->commit();
        
        return $game['konsolitunniste'];
    } catch (\Throwable $e) {
        $pdo->rollback();
        throw $e;
    }
}

// EOF