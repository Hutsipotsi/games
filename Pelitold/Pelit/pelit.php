<?php

	
	$kotisivunOsoite = "laksot.fi"; 
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
	<link rel="stylesheet" type="text/css" href="../tyylit.css"/>
	<link rel="SHORTCUT ICON" href="../kuvat/logo.jpg"/>
</head>
<body>
<h1><br/>Pelit, konsolit ja elokuvat</h1>

<div id="navigation">
<?php include "../napit.php"; ?>

<p><a href="istunto/index.php">Kirjaudu sis&auml;&auml;n</a></p>
</div>

<div id="text"><br/>
<p>T&auml;&auml;lt&auml; l&ouml;ytyv&auml;t meid&auml;n pelitietokannat ja elokuvat. Voit katsoa mit&auml; k&auml;si- ja pelikonsoleita, pelej&auml; sek&auml; elokuvia meill&auml; on. Peleiss&auml; haut toimivat niin, ett&auml; voit hakea yksitt&auml;in tai tyylilajin ja valmistajan tai tyylilajin ja konsolin mukaan esim. Seikkailupelit Nintendolta. Voit hakea pelej&auml; my&ouml;s nimihaulla, jolloin voit kirjoittaa koko nimen tai osan nimest&auml;. Elokuvahaussa nimien osat toimivat my&ouml;s. Elokuvista murto-osa on t&auml;ll&auml; hetkell&auml; listattuina.</p>
<br/><br/>

<form action="pelit.php" method="post"><pre><span style="font-family:times new romain; font-size: 12pt"><strong>Pelit valmistajittain:</strong>   <select name="pelit_valmistaja"><option value="Sega">Sega</option><option value="Nintendo">Nintendo</option><option value="Sony">Sony</option><option value="Microsoft">Microsoft</option><option value="PC">PC</option><option value="PC/MAC">PC/MAC</option><option value="Valitse" selected="selected">Valitse</option></select>    <strong>Pelit konsoleittain:</strong>   <?php 
include "yhteys.php";echo"<select name=\"pelit_konsoli\">";
//Haetaan valikkoon lista tietokannan pelityyleistä
$query = "SELECT DISTINCT malli FROM konsolit WHERE malli NOT LIKE '%Hero%' AND malli NOT LIKE '%Groud%' AND malli NOT LIKE '%Micro%' AND malli NOT LIKE '%One%' ORDER BY malli asc";

$result = mysql_query($query);

//luetaan php-taulukkoon
while ($newArray = mysql_fetch_array($result))
{
	$pelit_konsoli = $newArray['malli'];

	echo "<option value=\"$pelit_konsoli\">$pelit_konsoli</option>\n";
}
	echo "<option value=\"Valitse\" selected=\"selected\">Valitse";
	echo "</option></select>";
?><br/><br/><strong>Pelit tyylilajeittain:</strong>   <?php 
include "yhteys.php";echo"<select name=\"pelit_tyyli\">";
//Haetaan valikkoon lista tietokannan pelityyleistä
$query = "SELECT DISTINCT tyylilaji FROM pelit WHERE tyylilaji NOT LIKE '%/%' ORDER BY tyylilaji asc";

$result = mysql_query($query);

//luetaan php-taulukkoon
while ($newArray = mysql_fetch_array($result))
{
	$peli = $newArray['tyylilaji'];

	echo "<option value=\"$peli\">$peli</option>\n";
}
	echo "<option value=\"Valitse\" selected=\"selected\">Valitse";
	echo "</option></select>";
?>     <strong>Pelikonsolit:</strong>  <?php 
include "yhteys.php";echo"<select name=\"pelikonsolit\">";
//Haetaan valikkoon lista tietokannan pelityyleistä
$query = "SELECT DISTINCT valmistaja FROM pelikonsolit ORDER BY valmistaja asc";

$result = mysql_query($query);

//luetaan php-taulukkoon
while ($newArray = mysql_fetch_array($result))
{
	$pelikonsoli = $newArray['valmistaja'];

	echo "<option value=\"$pelikonsoli\">$pelikonsoli</option>\n";
}
	echo "<option value=\"kasikonsolit\">K&auml;sikonsolit</option>";
	echo "<option value=\"Kaikki\">Kaikki</option>";
	echo "<option value=\"Valitse\" selected=\"selected\">Valitse";
	echo "</option></select>";
?>
<br/>
<strong>Nimihaku:</strong> &nbsp;&nbsp;<input type ="text" name="pelin_nimi"/>       <!--<input type="submit" name="submit" value="Haenimi"/>-->      <strong>Haku:</strong>   <input type="submit" name="submit" value="Hae"/>
</span></pre>
</form>
<br/><br/>
<form method="post" action=""> 
<pre><span style="font-family:times new romain; font-size: 12pt"><strong>Elokuvat formaateittain:</strong>  <select name="elokuvat">
<option value="VHS">VHS</option>
<option value="DVD">DVD</option>
<option value="Kaikki">Kaikki</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>    <?php 
include "yhteys.php";echo"<strong>Elokuvat kategorioittain:</strong>   <select name=\"kategoria\">";
//Haetaan valikkoon lista tietokannan kursseista
$query = "SELECT DISTINCT kategoria FROM elokuvat WHERE kategoria NOT LIKE '%/%'ORDER BY kategoria asc";

$result = mysql_query($query);

//luetaan php-taulukkoon
while ($newArray = mysql_fetch_array($result))
{
	$kategoria = $newArray['kategoria'];

	echo "<option value=\"$kategoria\">$kategoria</option>\n";
}
	echo "<option value=\"Valitse\" selected='selected'>Valitse";
	echo "</option></select>";
?>
 &nbsp;&nbsp;<input type="submit" name="submit" value="Hae"/>
<br/>
<strong>Elokuvan nimen mukaan:</strong>     <input type ="text" name="nimi"/>    <input type="submit" name="submit" value="Haenimi"/><br/>
<strong>P&auml;&auml;osan esitt&auml;j&auml;n mukaan:</strong>   <input type ="text" name="paaosa"/>    <input type="submit" name="submit" value="Haep&auml;&auml;osa"/><br/>
<strong>Ohjaajan mukaan:</strong>                 <input type ="text" name="ohjaaja"/>    <input type="submit" name="submit" value="Haeohjaaja"/>
</span></pre>
</form>

<?php

include "yhteys.php";


//$submit=$_POST["submit"];

if(!empty($_POST["pelikonsolit"]))
{
//tästä alkaa Hae

if (($_POST["pelikonsolit"]!="Valitse" ) && ($_POST["pelit_konsoli"]=="Valitse") && ($_POST["pelit_valmistaja"]=="Valitse") && ($_POST["pelit_tyyli"]=="Valitse"))
{
$pelikonsoli=$_POST["pelikonsolit"];
if ($pelikonsoli=="Kaikki")
{
$kysely = "SELECT tekija AS valmistaja, konsoli As malli, kpl, vari FROM kasikonsolit UNION ALL SELECT valmistaja, malli, kpl, vari FROM pelikonsolit ORDER BY valmistaja, malli asc;";
}

elseif ($pelikonsoli=="kasikonsolit")
{
$kysely = "SELECT tekija AS valmistaja, konsoli AS malli, kpl, vari FROM kasikonsolit";
}

else {
$kysely = "SELECT valmistaja, malli, kpl, vari FROM pelikonsolit WHERE valmistaja='$pelikonsoli'";
}

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>valmistaja</b></td><td><b>malli</b></td><td><b>kpl</b></td><td><b>V&auml;ri</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $valmistaja = mysql_result($haku, $i, "valmistaja");
   $malli = mysql_result($haku, $i, "malli");
   $kpl = mysql_result($haku, $i, "kpl");
   $vari = mysql_result($haku, $i, "vari");
   $tekija = mysql_result($haku, $i, "valmistaja");
   $konsoli = mysql_result($haku, $i, "malli");
   //tulostetaan taulukon rivi
   echo "<tr><td>$valmistaja</td><td>$malli</td><td>$kpl</td><td>$vari</td></tr>";
}
echo "</table>";
}

if (($_POST["pelit_tyyli"]!="Valitse") && ($_POST["pelit_konsoli"]=="Valitse") && ($_POST["pelit_valmistaja"]=="Valitse") && ($_POST["pelikonsolit"]=="Valitse" ))
{
$peli=$_POST["pelit_tyyli"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND tyylilaji LIKE '$peli%' ORDER BY malli, pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ik&auml;suositus</b></td><td><b>Konsoli</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td><center>$ikasuositus</center></td><td>$malli</td></tr>";
}
echo "</table>";
}

elseif (($_POST["pelit_konsoli"]!="Valitse") && ($_POST["pelit_tyyli"]=="Valitse") && ($_POST["pelit_valmistaja"]=="Valitse"))
{
$pelit_konsoli=$_POST["pelit_konsoli"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND malli='$pelit_konsoli' ORDER BY pelin_nimi asc";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ik&auml;suositus</b></td><td><b>Konsoli</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td><center>$ikasuositus</center></td><td>$malli</td></tr>";
}
echo "</table>";
}

if (($_POST["pelit_valmistaja"]!="Valitse") && ($_POST["pelit_konsoli"]=="Valitse") && ($_POST["pelit_tyyli"]=="Valitse"))
{
$peliv=$_POST["pelit_valmistaja"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND valmistaja='$peliv' ORDER BY malli, pelin_nimi asc";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ik&auml;suositus</b></td><td><b>Konsoli</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td><center>$ikasuositus</center></td><td>$malli</td></tr>";
}
echo "</table>";
}

if (($_POST["pelit_tyyli"]!="Valitse") && ($_POST["pelit_valmistaja"]!="Valitse"))
{

$peli=$_POST["pelit_tyyli"];
$peliv=$_POST["pelit_valmistaja"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli, valmistaja FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND tyylilaji LIKE '$peli%' AND valmistaja='$peliv' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo"<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ik&auml;suositus</b></td><td><b>Konsoli</b></td><td><b>valmistaja</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   $valmistaja = mysql_result($haku, $i, "valmistaja");
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td><center>$ikasuositus</center></td><td>$malli</td><td>$valmistaja</td></tr>";
}
echo "</table>";
}

if (($_POST["pelit_tyyli"]!="Valitse") && ($_POST["pelit_konsoli"]!="Valitse"))
{

$peli=$_POST["pelit_tyyli"];
$pelit_konsoli=$_POST["pelit_konsoli"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli, valmistaja FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND tyylilaji LIKE '$peli%' AND malli='$pelit_konsoli' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo"<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ik&auml;suositus</b></td><td><b>Konsoli</b></td><td><b>valmistaja</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   $valmistaja = mysql_result($haku, $i, "valmistaja");
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td><center>$ikasuositus</center></td><td>$malli</td><td>$valmistaja</td></tr>";
}
echo "</table>";
}

if (($_POST["pelikonsolit"]!="Valitse" ) && ($_POST["pelit_tyyli"]!="Valitse"))
{
$pelikonsoli=$_POST["pelikonsolit"];
if ($pelikonsoli=="pelikonsolit")
{
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli, valmistaja AS pelikonsoli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND tyylilaji LIKE '$peli%' AND valmistaja='$pelikonsoli' ORDER BY pelin_nimi";

}
elseif ($pelikonsoli=="kasikonsolit")
{
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli, valmistaja AS kasikonsoli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND tyylilaji LIKE '$peli%' AND valmistaja='$kasikonsoli' ORDER BY pelin_nimi";
}

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo"<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ik&auml;suositus</b></td><td><b>Konsoli</b></td><td><b>valmistaja</b></td></tr>";


for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   $pelikonsoli = mysql_result($haku, $i, "pelikonsoli");
   $kasikonsoli = mysql_result($haku, $i, "kasikonsoli");
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td><center>$ikasuositus</center></td><td>$malli</td><td>$pelikonsoli</td></tr>";
}
echo "</table>";
}

//$submit=$_POST["submit"];

if(!empty($_POST["pelin_nimi"]))

if (($_POST["pelin_nimi"]!="Valitse") && ($_POST["pelikonsolit"]=="Valitse" ) && ($_POST["pelit_konsoli"]=="Valitse") && ($_POST["pelit_valmistaja"]=="Valitse") && ($_POST["pelit_tyyli"]=="Valitse"))
{
$pelinimi=$_POST["pelin_nimi"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND pelin_nimi LIKE '%$pelinimi%' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ik&auml;suositus</b></td><td><b>Konsoli</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $pelin_nimi = mysql_result($haku, $i, "pelin_nimi");
   $tyylilaji = mysql_result($haku, $i, "tyylilaji");
   $ikasuositus=mysql_result($haku, $i, "ikasuositus");
   $malli = mysql_result($haku, $i, "malli");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$pelin_nimi</td><td>$tyylilaji</td><td><center>$ikasuositus</center></td><td>$malli</td></tr>";
}
echo "</table>";
}
}

include "dbsulje.php";

?>

<?php

include "yhteys.php";


$submit=$_POST["submit"];

//tästä alkaa empty
if(!empty($_POST["elokuvat"]))
{

if ($submit=="Hae")
{
//tästä alkaa Hae

if ($_POST["elokuvat"]!="Valitse")
{
$elokuvat=$_POST["elokuvat"];
if ($elokuvat=="Kaikki")
{
$kysely = "SELECT nimi, paaosa, ohjaaja, kategoria, formaatti, kpl FROM elokuvat ORDER BY nimi";
}

else {
$kysely = "SELECT nimi, paaosa, ohjaaja, kategoria, formaatti, kpl FROM elokuvat WHERE formaatti='$elokuvat' ORDER BY nimi";
}
$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Elokuva</b></td><td><b>P&auml;&auml;osassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $nimi = mysql_result($haku, $i, "nimi");
   $paaosa = mysql_result($haku, $i, "paaosa");
   $ohjaaja = mysql_result($haku, $i, "ohjaaja");
   $kategoria = mysql_result($haku, $i, "kategoria");
   $formaatti = mysql_result($haku, $i, "formaatti");
   $kpl = mysql_result($haku, $i, "kpl");
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$nimi</td><td>$paaosa</td><td>$ohjaaja</td><td>$kategoria</td><td>$formaatti</td><td>$kpl</td></tr>";
}
echo "</table>";
}

if ($_POST["kategoria"]!="Valitse")
{
$kategoria=$_POST["kategoria"];
$kysely = "SELECT DISTINCT nimi, paaosa, ohjaaja, kategoria, formaatti, kpl FROM elokuvat WHERE kategoria='$kategoria' ORDER BY nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Elokuva</b></td><td><b>P&auml;&auml;osassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

    $nimi = mysql_result($haku, $i, "nimi");
   $paaosa = mysql_result($haku, $i, "paaosa");
   $ohjaaja = mysql_result($haku, $i, "ohjaaja");
   $kategoria = mysql_result($haku, $i, "kategoria");
   $formaatti = mysql_result($haku, $i, "formaatti");
   $kpl = mysql_result($haku, $i, "kpl");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$nimi</td><td>$paaosa</td><td>$ohjaaja</td><td>$kategoria</td><td>$formaatti</td><td>$kpl</td></tr>";
}
echo "</table>";
}
}
//tähän päättyy Hae

if ($submit=="Haenimi")
{
//tästä alkaa Haenimi
if ($_POST["nimi"]!="Valitse")
{
$nimi=$_POST["nimi"];
$kysely = "SELECT DISTINCT nimi, paaosa, ohjaaja, kategoria, formaatti, kpl FROM elokuvat WHERE nimi LIKE '%$nimi%' ORDER BY nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Elokuva</b></td><td><b>P&auml;&auml;osassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $nimi = mysql_result($haku, $i, "nimi");
   $paaosa = mysql_result($haku, $i, "paaosa");
   $ohjaaja = mysql_result($haku, $i, "ohjaaja");
   $kategoria = mysql_result($haku, $i, "kategoria");
   $formaatti = mysql_result($haku, $i, "formaatti");
   $kpl = mysql_result($haku, $i, "kpl");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$nimi</td><td>$paaosa</td><td>$ohjaaja</td><td>$kategoria</td><td>$formaatti</td><td>$kpl</td></tr>";
}
echo "</table>";
}
}
//tähän päättyy Haenimi
if ($submit=="Haepääosa")
{
if ($_POST["paaosa"]!="empty")
{

$paaosa=$_POST["paaosa"];
$kysely1 = "SELECT DISTINCT nimi, paaosa, ohjaaja, kategoria, formaatti, kpl FROM elokuvat WHERE paaosa LIKE '%$paaosa%' ORDER BY nimi";

$haku =mysql_query($kysely1);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Elokuva</b></td><td><b>P&auml;&auml;osassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $nimi = mysql_result($haku, $i, "nimi");
   $paaosa = mysql_result($haku, $i, "paaosa");
   $ohjaaja = mysql_result($haku, $i, "ohjaaja");
   $kategoria = mysql_result($haku, $i, "kategoria");
   $formaatti = mysql_result($haku, $i, "formaatti");
   $kpl = mysql_result($haku, $i, "kpl");
   
   //tulostetaan taulukon rivi
   echo "<tr><td>$nimi</td><td>$paaosa</td><td>$ohjaaja</td><td>$kategoria</td><td>$formaatti</td><td>$kpl</td></tr>";
}
echo "</table>";
}
}
//tähän päättyy Haepaaosa
if ($submit=="Haeohjaaja")
{
if ($_POST["ohjaaja"]!="empty")
{
$ohjaaja=$_POST["ohjaaja"];
$kysely = "SELECT DISTINCT nimi, paaosa, ohjaaja, kategoria, formaatti, kpl FROM elokuvat WHERE ohjaaja LIKE '%$ohjaaja%' ORDER BY nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Elokuva</b></td><td><b>P&auml;&auml;osassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {

   $nimi = mysql_result($haku, $i, "nimi");
   $paaosa = mysql_result($haku, $i, "paaosa");
   $ohjaaja = mysql_result($haku, $i, "ohjaaja");
   $kategoria = mysql_result($haku, $i, "kategoria");
   $formaatti = mysql_result($haku, $i, "formaatti");
   $kpl = mysql_result($haku, $i, "kpl");
   
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$nimi</td><td>$paaosa</td><td>$ohjaaja</td><td>$kategoria</td><td>$formaatti</td><td>$kpl</td></tr>";
}
echo "</table>";
}
}
//tähän päättyy Haeohjaaja
}
//tähän päättyy empty

include "dbsulje.php";


?>
</div>


<div id="laskuri">
<?php echo "Sivuillani on vierailtu: ";?><?php include($kavijatURL."kavijat.txt"); echo ' kertaa';?><br/>
<?php echo 'Sivuja on ladattu: '?><?php include($kavijatURL."lataukset.txt"); ?><?php echo ' kertaa';?>
<br/><br/>©ELakso 2010
</div>
</body>
</html>
