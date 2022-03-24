<div id="kuvat">
<form method="post" action=""> 
<pre><span style="font-family:times new romain; font-size: 12pt"><b>K&auml;sikonsolit:</b>              <select name="kasikonsolit">
<option value="Kaikki">Kaikki</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>          <strong>Pelikonsolit:</strong>           <?php 
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
	echo "<option value=\"Kaikki\">Kaikki</option>";
	echo "<option value=\"Valitse\" selected=\"selected\">Valitse";
	echo "</option></select>";
?><!--<b>Pelikonsolit:</b>            <select name="pelikonsolit">
<option value="Sega">Sega</option>
<option value="Sony">Sony</option>
<option value="Nintendo">Nintendo</option>
<option value="Microsoft">Microsoft</option>
<option value="Kaikki">Kaikki</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>--><br/><br/><b>Pelit valmistajittain:</b>  <select name="pelit_valmistaja">
<option value="Sega">Sega</option>
<option value="Nintendo">Nintendo</option>
<option value="Sony">Sony</option>
<option value="Microsoft">Microsoft</option>
<option value="PC">PC</option>
<option value="PC/MAC">PC/MAC</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>       <b>Pelit tyylilajeittain:</b>  <select name="pelit_tyyli">
<?php 
include "yhteys.php";
//Haetaan valikkoon lista tietokannan kursseista
$query = "SELECT DISTINCT tyylilaji FROM pelit WHERE tyylilaji NOT LIKE '%/%' ORDER BY tyylilaji asc";

$result = mysql_query($query);

//luetaan php-taulukkoon
while ($newArray = mysql_fetch_array($result))
{
	$peli = $newArray['tyylilaji'];

	echo "<option value=$peli>$peli";
}
?>
<option value="Valitse" selected="selected">Valitse</option>
</select><br/>
<b>Hae 1 tai useampi taulu:  <input type="submit" name="submit" value="Hae"/>           Hae kahden pelimuuttujan mukaan:  </b><input type="submit" name="submit" value="Hae2"/><br/>
<b>Nimihaku:   </b><input type ="text" name="pelin_nimi"/>   <input type="submit" name="submit" value="Haenimi"/></span></pre>

</form>
<br/>
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
$kysely = "SELECT tekija, konsoli, kpl, vari FROM kasikonsolit";
$haku =mysql_query($kysely);
echo "<table border cellpadding=5>";
echo "<tr><td><b>Valmistaja</b></td><td><b>Malli</b></td><td><b>kpl</b></td><td><b>Väri</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {
  
   $tekija = mysql_result($haku, $i, "tekija");
   $konsoli = mysql_result($haku, $i, "konsoli");
   $kpl = mysql_result($haku, $i, "kpl");
   $vari = mysql_result($haku, $i, "vari");
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$tekija</td><td>$konsoli</td><td>$kpl</td><td>$vari</td></tr>";
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
echo "<br/><table border cellpadding=5>";
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
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND tyylilaji LIKE '$peli%' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ikäsuositus</b></td><td><b>Konsoli</b></td></tr>";

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

if ($_POST["pelit_valmistaja"]!="Valitse")
{
$peliv=$_POST["pelit_valmistaja"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND valmistaja='$peliv' ORDER BY malli, pelin_nimi asc";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ikäsuositus</b></td><td><b>Konsoli</b></td></tr>";

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
//tähän päättyy Hae1

if ($submit=="Hae2")
{
if ($_POST["pelit_tyyli"]!="Valitse"&&$_POST["pelit_valmistaja"]!="Valitse")
{

$peli=$_POST["pelit_tyyli"];
$peliv=$_POST["pelit_valmistaja"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli, valmistaja FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND tyylilaji LIKE '$peli%' AND valmistaja='$peliv' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo"<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ikäsuositus</b></td><td><b>Konsoli</b></td><td><b>valmistaja</b></td></tr>";

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
}
//tähän päättyy Hae2

if ($submit=="Haenimi")
{
//tästä alkaa Haenimi
if ($_POST["pelin_nimi"]!="Valitse")
{
$pelinimi=$_POST["pelin_nimi"];
$kysely = "SELECT DISTINCT pelin_nimi, tyylilaji, ikasuositus, malli FROM pelit, tunnisteet WHERE tunnisteet.tunniste_id=pelit.tunniste AND pelin_nimi LIKE '%$pelinimi%' ORDER BY pelin_nimi";

$haku =mysql_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>Peli</b></td><td><b>Tyylilaji</b></td><td><b>Ikäsuositus</b></td><td><b>Konsoli</b></td></tr>";

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
//tähän päättyy Haenimi
//tähän päättyy empty
}

include "dbsulje.php";


?>
<br/><br/><br/><br/><br/><br/>
</div>