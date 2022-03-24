<?php
/*Otetaan yhteys tietokantaan*/
error_reporting(0);
$host="localhost";
$user="";//k�ytt�j�tunnus
$pass="";//salasana
$db="Pelit";//k�ytett�v� tietokanta

/*otetaan yhteys tietokanta palvelimeen*/
$link= mysql_connect($host,$user,$pass);

if(!$link) die("Yhteytta tietokantapalvelimeen ei saatu");

/*valitaan palvelimelta k�ytett�v� tietokanta*/
mysql_select_db($db)
or die("Yhteytta ei saatu tietokantaan $db". mysql_error());

mysql_query("SET NAMES 'utf8'");
?>
