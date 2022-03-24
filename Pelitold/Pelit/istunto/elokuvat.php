<div id="kuvat">
<div id="kp">
<form method="post" action=""> 
<pre><span style="font-family:times new romain"><b>Elokuvat formaateittain:</b>  <select name="elokuvat">
<option value="VHS">VHS</option>
<option value="DVD">DVD</option>
<option value="Kaikki">Kaikki</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>	<b>Elokuvat kategorioittain:</b>  <select name="kategoria">
<?php 
include "yhteys.php";
//Haetaan valikkoon lista tietokannan kursseista
$query = "SELECT DISTINCT kategoria FROM elokuvat WHERE kategoria NOT LIKE '%/%'ORDER BY kategoria asc";

$result = mysql_query($query);

//luetaan php-taulukkoon
while ($newArray = mysql_fetch_array($result))
{
	$kategoria = $newArray['kategoria'];

	echo "<option value=$kategoria>$kategoria";
}
?>
<option value="Valitse" selected="selected">Valitse</option>
</select> &nbsp;&nbsp;<input type="submit" name="submit" value="Hae"/>
<br/>
<b>Elokuvan nimen mukaan:</b>	<input type ="text" name="nimi"/>	<input type="submit" name="submit" value="Haenimi"/><br/>
<b>P&auml;&auml;osan esitt&auml;j&auml;n mukaan:</b>	<input type ="text" name="paaosa"/>	<input type="submit" name="submit" value="Haep&auml;&auml;osa"/><br/>
<b>Ohjaajan mukaan:</b>		<input type ="text" name="ohjaaja"/>	<input type="submit" name="submit" value="Haeohjaaja"/>
</span></pre>
</form>
</div>
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
echo "<tr><td><b>Elokuva</b></td><td><b>Pääosassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

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
echo "<tr><td><b>Elokuva</b></td><td><b>Pääosassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

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
echo "<tr><td><b>Elokuva</b></td><td><b>Pääosassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

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
echo "<tr><td><b>Elokuva</b></td><td><b>Pääosassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

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
echo "<tr><td><b>Elokuva</b></td><td><b>Pääosassa</b></td><td><b>Ohjaaja</b></td><td><b>Kategoria</b></td><td><b>Formaatti</b></td><td><b>Kpl</b></td></tr>";

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
<br/>