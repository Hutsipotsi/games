<?php

function getPelitNimi ($nimihaku) {
    require_once MODULES_DIR.'db.php';

            $pdo = getPdoConnection();
            
            try {
                $pdo->beginTransaction();

                $sql = "SELECT peli.id, peli.nimi, peli.ikasuositus, konsolitunniste.malli, group_concat(genre.tyylilaji) as tyylilaji
                FROM peli
                INNER JOIN konsolitunniste
                ON peli.konsolitunniste = konsolitunniste.id
                INNER JOIN yhdistelmagenre
                ON peli.id = yhdistelmagenre.peli_id
                INNER JOIN genre
                ON yhdistelmagenre.genre_id = genre.id
                WHERE peli.nimi LIKE '%$nimihaku%'
                GROUP BY peli.id";
                
                $statement = $pdo->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                $pdo->commit();
                return $result;
            }
            catch(\Throwable $pdoex) {
                $pdo->rollback();
                throw $pdoex;
            }
}

function getPelitV($valmistaja) {
    require_once MODULES_DIR . 'db.php';
    
    $pdo = getPdoConnection();
    
    try {
        $pdo->beginTransaction();
        $sql = "SELECT peli.id, peli.nimi, peli.ikasuositus, konsolitunniste.malli, group_concat(genre.tyylilaji) as tyylilaji
        FROM peli
        INNER JOIN konsolitunniste
        ON peli.konsolitunniste = konsolitunniste.id
        INNER JOIN yhdistelmagenre
        ON peli.id = yhdistelmagenre.peli_id
        INNER JOIN genre
        ON yhdistelmagenre.genre_id = genre.id
        WHERE valmistaja = '$valmistaja'
        GROUP BY peli.id";
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
        $pdo->commit();
        }
        catch(\Throwable $pdoex) {
            $pdo->rollback();
            throw $pdoex;
            }
  }  

  function getPelitM($malli) {
    require_once MODULES_DIR . 'db.php';
                
        $pdo = getPdoConnection();

        try {
            $pdo->beginTransaction();
            $sql = "SELECT peli.id, peli.nimi, peli.ikasuositus, konsolitunniste.malli, group_concat(genre.tyylilaji) as tyylilaji
            FROM peli
            INNER JOIN konsolitunniste
            ON peli.konsolitunniste = konsolitunniste.id
            INNER JOIN yhdistelmagenre
            ON peli.id = yhdistelmagenre.peli_id
            INNER JOIN genre
            ON yhdistelmagenre.genre_id = genre.id
            WHERE malli = '$malli'
            GROUP BY peli.id";
            
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pdo->commit();
            return $result;            
            }
            catch(\Throwable $pdoex) {
                $pdo->rollback();
                throw $pdoex;
            }
        }

        function getPelitT($tyylilaji) {
            require_once MODULES_DIR . 'db.php';
    
            $pdo = getPdoConnection();

            try {
                $pdo->beginTransaction();

                $sql = "SELECT peli.id, peli.nimi, peli.ikasuositus, konsolitunniste.malli, group_concat(genre.tyylilaji) as tyylilaji
                FROM peli
                INNER JOIN konsolitunniste
                ON peli.konsolitunniste = konsolitunniste.id
                INNER JOIN yhdistelmagenre
                ON peli.id = yhdistelmagenre.peli_id
                INNER JOIN genre
                ON yhdistelmagenre.genre_id = genre.id
                GROUP BY peli.id
                HAVING find_in_set('$tyylilaji', tyylilaji);";
                
                $statement = $pdo->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                $pdo->commit();
                return $result;
                }
                catch(\Throwable $pdoex) {
                    $pdo->rollback();
                    throw $pdoex;
                    }
                }

function getPelitVt($valmistaja, $tyylilaji) {
    require_once MODULES_DIR . 'db.php';

                $pdo = getPdoConnection();

            try {
                $pdo->beginTransaction();
                $sql="SELECT peli.id, peli.nimi, peli.ikasuositus, konsolitunniste.malli, group_concat(genre.tyylilaji) as tyylilaji
                FROM peli
                INNER JOIN konsolitunniste
                ON peli.konsolitunniste = konsolitunniste.id
                INNER JOIN yhdistelmagenre
                ON peli.id = yhdistelmagenre.peli_id
                INNER JOIN genre
                ON yhdistelmagenre.genre_id = genre.id
                WHERE konsolitunniste.valmistaja = '$valmistaja'
                GROUP BY peli.id
                HAVING find_in_set('$tyylilaji', tyylilaji)";

               
            
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pdo->commit();
            return $result;
            }
            catch(\Throwable $pdoex) {
                $pdo->rollback();
                throw $pdoex;
            }
        }

function getPelitMt($malli, $tyylilaji) {
    require_once MODULES_DIR . 'db.php';
    
            $pdo = getPdoConnection();

            try {
                $pdo->beginTransaction();

                $sql = "SELECT peli.id, peli.nimi, peli.ikasuositus, konsolitunniste.malli, group_concat(genre.tyylilaji) as tyylilaji
                FROM peli
                INNER JOIN konsolitunniste
                ON peli.konsolitunniste = konsolitunniste.id
                INNER JOIN yhdistelmagenre
                ON peli.id = yhdistelmagenre.peli_id
                INNER JOIN genre
                ON yhdistelmagenre.genre_id = genre.id
                WHERE konsolitunniste.malli = '$malli'
                GROUP BY peli.id
                HAVING find_in_set('$tyylilaji', tyylilaji);";
            
                $statement = $pdo->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                return $result;
                $pdo->commit();
                return $result;
                }
                catch(\Throwable $pdoex) {
                    $pdo->rollback();
                    throw $pdoex;
                }
            }

            function getKonsolit($konsoli){
                require_once MODULES_DIR.'db.php';
            
                $pdo = getPdoConnection();
            
                try {
                    $pdo->beginTransaction();
            
                if($konsoli==='Kaikki') {
                    $sql = "SELECT valmistaja, malli, kpl, vari, konsolityyppi FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste";
                }
                elseif(($konsoli==='Pelikonsoli') || ($konsoli==='Käsikonsoli')) {
                    $sql = "SELECT valmistaja, malli, kpl, vari, konsolityyppi FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND konsolityyppi = '$konsoli'";
                }
                else {
                    $sql = "SELECT valmistaja, malli, kpl, vari, konsolityyppi FROM konsolitunniste, konsoli WHERE konsolitunniste.id = konsoli.konsolitunniste AND valmistaja='$konsoli'";   
                }
            
                    $statement = $pdo->prepare($sql);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $pdo->commit();
                    return $result;
                }
                catch(\Throwable $pdoex) {
                    $pdo->rollback();
                    throw $pdoex;
                }
            }
?>