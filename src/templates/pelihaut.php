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

function getPelitV($valmistaja) {
    require_once MODULES_DIR . 'db.php';
    
    $pdo = getPdoConnection();
    
    try {
        $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND valmistaja = '$valmistaja'";
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
        }
        catch(\Throwable $pdoex) {
            throw $pdoex;
            }
  }  

  function getPelitM($malli) {
    require_once MODULES_DIR . 'db.php';
                
        $pdo = getPdoConnection();
        try {
            $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND malli = '$malli'";
            
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
            }
            catch(\Throwable $pdoex) {
                throw $pdoex;
            }
        }

        function getPelitT($tyylilaji) {
            require_once MODULES_DIR . 'db.php';
    
            $pdo = getPdoConnection();
            try {
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND tyylilaji = '$tyylilaji'";
                
                $statement = $pdo->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                return $result;
                }
                catch(\Throwable $pdoex) {
                    throw $pdoex;
                    }
                }

function getPelitVt($valmistaja, $tyylilaji) {
    require_once MODULES_DIR . 'db.php';

                $pdo = getPdoConnection();
            try {
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND valmistaja = '$valmistaja' AND tyylilaji = '$tyylilaji'";
            
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
            }
            catch(\Throwable $pdoex) {
                throw $pdoex;
            }
        }

function getPelitMt($malli, $tyylilaji) {
    require_once MODULES_DIR . 'db.php';
    
            $pdo = getPdoConnection();
            try {
                $sql = "SELECT DISTINCT nimi, tyylilaji, ikasuositus, malli FROM peli, yhdistelmagenre, genre, konsolitunniste WHERE peli.id = yhdistelmagenre.peli_id AND yhdistelmagenre.genre_id = genre.id AND peli.konsolitunniste = konsolitunniste.id AND malli = '$malli' AND tyylilaji = '$tyylilaji'";
            
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
                    return $result;
                }
                catch(\Throwable $pdoex) {
                    throw $pdoex;
                }
            }
?>