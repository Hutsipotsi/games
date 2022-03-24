<div id="kuvat">
<p>Lisää tai poista elokuvia tietokannasta.</p> 
<div id="kp">
<form method="post" action=""><pre><span style="font-family:times new romain"> 
<b>Elokuvan nimi:</b>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="nimi"/><br/>
<b>Pääosassa:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="paaosa"/><br/>
<b>Ohjaaja:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ohjaaja"/><br/>
<b>Kategoria:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="kategoria"/><br/>
<b>Formaatti:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="formaatti"/><br/>
<b>Kpl:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="kpl"/><br/>

<input type="submit" name="submit" value="Tallenna"/>	<input type="submit" name="submit" value="Poista"/></span>
</pre></form>
</div>
<?php

include "yhteys.php";


$submit=$_POST["submit"];

$elokuva_id=$_POST["elokuva_id"];
$nimi=$_POST["nimi"];
$paaosa=$_POST["paaosa"];
$ohjaaja=$_POST["ohjaaja"];
$kategoria=$_POST["kategoria"];
$formaatti=$_POST["formaatti"];
$kpl=$_POST["kpl"];


if (!empty($nimi))
{
//tästä alkaa empty

if ($submit=="Tallenna")
{
//tästä alkaa Tallenna
$kysely = "INSERT INTO elokuvat (elokuva_id, nimi, paaosa, ohjaaja, kategoria, formaatti, kpl) VALUES
('',  '$nimi', '$paaosa', '$ohjaaja', '$kategoria', '$formaatti', '$kpl')";

$haku =mysql_query($kysely, $link);

if(!$haku)
die ("Tietojen lisääminen tietokantaan ei onnistunut".mysql_error());
}
if($haku)
{
print "Elokuva lisätty tietokantaan nimellä: $nimi";
}
//tähän päättyy tallenna

if ($submit=="Poista")
{
//tästä alkaa poista
$kysely = "DELETE FROM elokuvat WHERE nimi='$pelinimi'";

$query =mysql_query($kysely, $link);

if(!$query)
die ("Tietojen poistaminen tietokannasta ei onnistunut".mysql_error());
}
if($query)
{
print "Elokuva poistettu tietokannasta nimellä: $nimi";
}
}

include "dbsulje.php";

?>
</div>