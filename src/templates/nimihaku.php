<?php

function getPelitNimi ($nimihaku) {
    require_once MODULES_DIR.'db.php';

            $pdo = getPdoConnection();
            try {
                
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND nimi LIKE '%$nimihaku%';";
                
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