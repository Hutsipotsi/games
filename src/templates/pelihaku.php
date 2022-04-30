<?php

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
            //$statement->bindParam(1, $valmistaja);
            //$statement->bindParam(2, $tyylilaji);
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
