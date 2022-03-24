<?php
include("yhteys.php");
// generoidaan sql-lause merkkijonoksi
$sql = "CREATE TABLE elokuvat";
$sql.= "(elokuva_id INTEGER (2) AUTO_INCREMENT PRIMARY KEY, nimi VARCHAR (50) COLLATE utf8_unicode_ci, paaosa VARCHAR (50), ohjaaja VARCHAR (50), kategoria VARCHAR (25), formaatti CHAR (3), kpl INT (2))ENGINE=MyISAM DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci";
mysql_query($sql);
print("elokuvat - taulu luotu");
?>
