<?php
/*Otetaan yhteys tietokantaan*/
$host="localhost";
$user="";//käyttäjätunnus
$pass="";//salasana
$db="Pelit";//käytettävä tietokanta

/*otetaan yhteys tietokanta palvelimeen*/
$link= mysql_connect($host,$user,$pass);

if(!$link) die("Yhteyttä tietokantapalvelimeen ei saatu");

/*valitaan palvelimelta käytettävä tietokanta*/
mysql_select_db($db)
or die("Yhteyttä ei saatu tietokantaan $db". mysql_error());

mysql_query("SET NAMES 'utf8'");
?>