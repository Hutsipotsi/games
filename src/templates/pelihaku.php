<?php

function getPelitG($genre) {
    require_once MODULES_DIR . 'db.php';
    
    try {
        $pdo = getPdoConnection();
        $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND valmistaja = '$pvalmistaja' AND tyylilaji = '$genre';";
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
        }
        catch(\Throwable $pdoex) {
            throw $pdoex;
        }
    }
        

function getPelitV($genre, $pvalmistaja, $pmalli) {
    require_once MODULES_DIR . 'db.php';
    
    try {
        if($_POST===$pvalmistaja && $_POST===$genre) {
            $pdo = getPdoConnection();
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND valmistaja = '$pvalmistaja' AND tyylilaji = '$genre';";
            }
            elseif($_POST===$pmalli && $_POST===$genre) {
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND malli = '$pmalli' AND tyylilaji = '$genre'";
            }
            elseif($_POST===$pmalli) {
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND malli = '$pmalli'";
            }
            elseif($_POST===$genre) {
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND tyylilaji = '$genre'";
            }
            else {
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND valmistaja = '$pvalmistaja'";
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