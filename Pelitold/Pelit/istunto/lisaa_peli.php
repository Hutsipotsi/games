<div id="kuvat">
<p>Lis&auml;&auml; tai poista pelej&auml; tietokannasta. Tallentaessa kaikki kent&auml;t pakollisia, poistossa pelin nimi ja tunnistenumero. Onnistunut tallennus tai poisto antaa palautteena pelin nimen.</p>
<!--<form method="post" action="<?php $_SESSION['PHP_SELF']?>">--> 
<!--<form method="post" action="<?php print $PHP_SELF;?>">-->
<div id="kp">
<form method="post" action=""> 
<pre><span style="font-family:times new romain"><b>Pelin nimi:</b>             <input type="text" name="pelin_nimi"/><br/>
<b>Pelikategoria:</b>       <select name="tyylilaji">
<?php 
include "yhteys.php";
//Haetaan valikkoon lista tietokannan tyyleistä
$query = "SELECT DISTINCT tyylilaji FROM genret ORDER BY tyylilaji asc";

$result = mysql_query($query);

//luetaan php-taulukkoon
while ($newArray = mysql_fetch_array($result))
{
	$tyylilaji = $newArray['tyylilaji'];

	echo "<option value='$tyylilaji'>$tyylilaji";
}
?>
<option value="Valitse" selected="selected">Valitse</option>
</select><br/>
<b>Ik&auml;suositus:</b>           <input type="text" name="ikasuositus"/><br/>
<b>Tunnistenumero:</b>   <input type="text" name="tunniste"/><br/>
</span></pre>
<input type="submit" name="submit" value="Tallenna"/> &nbsp;&nbsp;&nbsp; <input type="submit" name="submit" value="Poista"/>
<br/><br/>
<p><b>Tunnisteet: &nbsp;&nbsp;&nbsp;</b><select name="tunniste_id">
<option value="Kaikki">Kaikki</option>
<option value="Valitse" selected="selected">Valitse</option>
</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Hae"/></p>
</form>
</div>
<?php

include "yhteys.php";


$submit=$_POST["submit"];

$peli_id=$_POST["pelit_id"];
$pelinimi=$_POST["pelin_nimi"];
$tyylilaji=$_POST["tyylilaji"];
$ikasuositus=$_POST["ikasuositus"];
$tunniste=$_POST["tunniste"];
$tunniste_id=$_POST["tunniste_id"];

if ($submit=="Hae")
{
//tästä alkaa Hae

if ($_POST["tunniste_id"])
{
$kysely = "SELECT tunniste_id, malli FROM tunnisteet";
$haku =mysql_query($kysely);
echo "<table border cellpadding=5>";

echo "<tr><td><b>Tunniste</b></td><td><b>Malli</b></td></tr>";

for ($i = 0; $i <mysql_num_rows($haku); $i++) {
  
   $tunniste_id = mysql_result($haku, $i, "tunniste_id");
   $malli = mysql_result($haku, $i, "malli");
  
   //tulostetaan taulukon rivi
   echo "<tr><td>$tunniste_id</td><td>$malli</td></tr>";
}
echo "</table>";
}
}

if (!empty($pelinimi)&&!empty($tunniste))
//tästä alkaa empty

if ($submit=="Poista")
{
//tästä alkaa poista
$kysely2 = "DELETE FROM pelit WHERE pelin_nimi='$pelinimi' AND tunniste='$tunniste'";

$query2 =mysql_query($kysely2, $link);

if(!$query2)
die ("Tietojen poistaminen tietokannasta ei onnistunut".mysql_error());
}
if($query2)
{
print "Peli poistettu tietokannasta nimellä: $pelinimi";
}

if (!empty($pelinimi)&&!empty($tyylilaji)&&!empty($ikasuositus)&&!empty($tunniste))
{

if ($submit=="Tallenna")
{
//tästä alkaa Tallenna
$kysely = "INSERT INTO pelit (pelin_nimi, tyylilaji, ikasuositus, tunniste) VALUES ('$pelinimi', '$tyylilaji', '$ikasuositus', '$tunniste')";

$haku =mysql_query($kysely, $link);

if(!$haku)
die ("Tietojen lisääminen tietokantaan ei onnistunut".mysql_error());
}
if($haku)
{
print "Peli lisätty tietokantaan nimellä: $pelinimi";
}
//tähän päättyy tallenna


}

include "dbsulje.php";

?>
</div>