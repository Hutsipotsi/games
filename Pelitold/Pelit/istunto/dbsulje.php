<?php
/*Otetaan yhteys tietokantaan*/
//$host="localhost";
//$user="";//käyttäjätunnus
//$pass="";//salasana
//$db="pelitdb";//käytettävä tietokanta

/*otetaan yhteys tietokanta palvelimeen*/
//$link= mysql_connect($host,$user,$pass);

//if(!$link) die("Yhteytta tietokantapalvelimeen ei saatu");

/*valitaan palvelimelta käytettävä tietokanta*/
//mysql_select_db($db)
//or die("Yhteyttä ei saatu tietokantaan $db". mysql_error());
mysql_close(); 

?>
