<?php

	
	$kotisivunOsoite = "www.lakso.org/portfolio"; 
	$kotisivunJuuri = $kotisivunOsoite."/";
	
	$haettuURL = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	while (eregi("//", $haettuURL)) {
		$haettuURL = str_replace("//", "/", $haettuURL);
	}


	$osoiteSuhteessaJuureen = str_replace($kotisivunJuuri, "", $haettuURL);
	$kauttaviivat = substr_count($osoiteSuhteessaJuureen, "/");
	$suhteellinenOsoite = str_repeat("./", $kauttaviivat);
	$kavijatURL = $suhteellinenOsoite."kavijat/";

	include($kavijatURL."laskuri.php");

?><!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi" >
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Pelit</title> 
	<link rel="stylesheet" type="text/css" href="tyylit.css"/>
	<link rel="SHORTCUT ICON" href="logo.jpg"/>
</head>
<body>
<h1><br/>Pelit ja konsolit</h1>

<div id="navigation">
<p><a href="http://www.lakso.org/index.php"><button type="button"><font face="Verdana" size="2" color="darkblue"><b>Etusivu</b></font></button></a></p>
<p><a href="index.php"><button type="button"><font face="Verdana" size="2" color="darkblue"><b>Portfolio</b></font></button></a></p>
<p><a href="kuvankasittely.html"><button type="button"><font face="Verdana" size="2" color="darkblue"><b>Kuvankäsittely</b></font></button></a></p> 
<p><a href="http://www.lakso.org/kuvat.html"><button type="button"><font face="Verdana" size="2" color="darkblue"><b>Kuvia</b></font></button></a></p>
<p><a href="http://www.lakso.org/vieraskirja.php"><button type="button"><font face="Verdana" size="2" color="darkblue"><b>Vieraskirja</b></font></button></a></p>                 <p><a href="http://www.lakso.org/tietoa_sivustosta.php"><button type="button"><font face="Verdana" size="2" color="darkblue"><b>Info</b></font></button></a></p>
<img src="kuvat/PoweredByMacOSX.gif" alt="logo"/>
<div id="navigation2"><p>
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" border="0" /></a>
  </p>
<?php
echo "Sivua on päivitetty viimeksi: " . date ("d.m.Y H:i:s", getlastmod());
?>
<p><a href="istunto/kirjautumis_sivu.php">Kirjaudu sisään</a></p>
</div>
</div>
<div id="text">
<form action="pelit.php" method="post">
<b>Käsikonsolit:</b>
<select name="kasikonsolit">
<option value="Kaikki">Kaikki</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>
<b>Pelikonsolit:</b> 
<select name="pelikonsolit">
<option value="Sega">Sega</option>
<option value="Nintendo">Nintendo</option>
<option value="Microsoft">Microsoft</option>
<option value="Kaikki">Kaikki</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>
<b>Pelit tyylilajeittain:</b> 
<select name="pelit_tyyli">
<option value="Ajopeli">Ajopeli</option>
<option value="Ammunta">Ammunta</option>
<option value="Arcade">Arcade</option>
<option value="First-person action-adventure">First-person action-adventure</option>
<option value="First-person shooter">First-person shooter</option>
<option value="Inter Active">Inter Active</option>
<option value="Karaoke">Karaoke</option>
<option value="Kauhu">Kauhu</option>
<option value="Musiikki">Musiikki</option>
<option value="Piirustus">Piirustus</option>
<option value="Puzzle">Puzzle</option>
<option value="Pyöräily">Pyöräily</option>
<option value="Ralli">Ralli</option>
<option value="Ratsastus">Ratsastus</option>
<option value="Reaaliaikainen strategiapeli">Reaaliaikainen strategiapeli</option>
<option value="Rooli">Rooli</option>
<option value="Seikkailu">Seikkailu</option>
<option value="Simulaatio">Simulaatio</option>
<option value="Tasoloikka">Tasoloikka</option>
<option value="Taistelu">Taistelu</option>
<option value="Tanssi">Tanssi</option>
<option value="Third-person shooter">Third-person shooter</option>
<option value="Toiminta">Toiminta</option>
<option value="Urheilu">Urheilu</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>
<b>Pelit valmistajittain:</b> 
<select name="pelit_valmistaja">
<option value="Sega">Sega</option>
<option value="Nintendo">Nintendo</option>
<option value="Sony">Sony</option>
<option value="Microsoft">Microsoft</option>
<option value="PC">PC</option>
<option value="PC/MAC">PC/MAC</option>
<option value="Valitse" selected="selected">Valitse</option>
</select><br/>
<p>Hae 1 tai useampi vaihtoehto: <input type="submit" name="submit" value="Hae"/>
Hae 2 pelimuuttujaa: <input type="submit" name="submit" value="Hae2"/></p>
</form>
<br/><br/>


<?php
include "yhteys.php";


$submit=$_POST["submit"];

//tästä alkaa empty
if(!empty($_POST["kasikonsolit"]))
{

if ($submit=="Hae")
{
//tästä alkaa Hae

if ($_POST["kasikonsolit"]!="Valitse" )
{
$kysely = "SELECT valmistaja, malli, kpl, vari FROM kasikonsolit";
$haku =mysql_query($kysely);
echo "<table border>";
echo "<tr><td><b>Valmistaja</b></td><td><b>Malli</b></td><td><b>kpl</b></td><td><b>Väri</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {
  
   $valmistaja = mysql_result($haku, $i, "valmistaja");
   $malli = mysql_result($haku, $i, "malli");
   $kpl = mysql_result($haku, $i, "kpl");
   $vari = mysql_result($haku, $i, "vari");
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$valmistaja</td><td>$malli</td><td>$kpl</td><td>$vari</td></tr>";
}
echo "</table>";
}

if ($_POST["pelikonsolit"]!="Valitse")
{
$pelikonsoli=$_POST["pelikonsolit"];
if ($pelikonsoli=="Kaikki")
{
$kysely = "SELECT valmistaja, malli, kpl FROM pelikonsolit";

}
else {
$kysely = "SELECT valmistaja, malli, kpl FROM pelikonsolit WHERE valmistaja='$pelikonsoli'";
}
$haku =mysql_query($kysely);
echo "<br/><table border>";
echo "<tr><td><b>valmistaja</b></td><td><b>malli</b></td><td><b>kpl</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $valmistaja = mysql_result($haku, $i, "valmistaja");
   $malli = mysql_result($haku, $i, "malli");
   $kpl = mysql_result($haku, $i, "kpl");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$valmistaja</td><td>$malli</td><td>$kpl</td></tr>";
}
echo "</table>";
}

if ($_POST["pelit_tyyli"]!="Valitse")
{
$peli=$_POST["pelit_tyyli"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste=pelit.tunniste AND tyylilaji LIKE '$peli%' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ikäsuositus</b></td><td><b>Konsoli</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td>$ikasuositus</td><td>$malli</td></tr>";
}
echo "</table>";
}

if ($_POST["pelit_valmistaja"]!="Valitse")
{
$peliv=$_POST["pelit_valmistaja"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste=pelit.tunniste AND valmistaja='$peliv' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ikäsuositus</b></td><td><b>Konsoli</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td>$ikasuositus</td><td>$malli</td></tr>";
}
echo "</table>";
}
}
//tähän päättyy Hae
//tästä alkaa Hae2
if ($submit=="Hae2")
{
if ($_POST["pelit_tyyli"]!="Valitse"&&$_POST["pelit_valmistaja"]!="Valitse")
{

$peli=$_POST["pelit_tyyli"];
$peliv=$_POST["pelit_valmistaja"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli, valmistaja FROM pelit, tunnisteet WHERE tunnisteet.tunniste=pelit.tunniste AND tyylilaji LIKE '$peli%' AND valmistaja='$peliv' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border>";
echo"<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ikäsuositus</b></td><td><b>Konsoli</b></td><td><b>valmistaja</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   $valmistaja = mysql_result($haku, $i, "valmistaja");
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td>$ikasuositus</td><td>$malli</td><td>$valmistaja</td></tr>";
}
echo "</table>";
}
//tähän päättyy Hae2
}
//tähän päättyy empty
}


/*
include "kyselyt_pelit.php";
 header("Location: pelit.php");
*/
?>


</div>


</body>
</html>
