<div id="kuvat">
<p>Lis&auml;&auml; k&auml;ytt&auml;ji&auml; tietokantaan.</p>
<!--<form method="post" action="<?php $_SESSION['PHP_SELF']?>">--> 
<!--<form method="post" action="<?php print $PHP_SELF;?>">-->
<div id="kp">
<form method="post" action=""> 
<pre><span style="font-family:times new romain"><b>K&auml;ytt&auml;j&auml;tunnus:</b>   <input type="text" name="tunnus"/><br/>
<b>Salasana:</b>              <input type="text" name="salasana"/><br/>
<b>email:</b>                    <input type="text" name="email"/><br/>
<b>Admin numero:</b>   <input type="text" name="admin"/><br/>

<input type="submit" name="submit" value="Tallenna"/>     <input type="submit" name="submit" value="Poista"/></span></pre>
</form>
</div>
<?php

include "yhteys.php";


$submit=$_POST["submit"];

$id=$_POST["id"];
$tunnus=$_POST["tunnus"];
$salasana=$_POST["salasana"];
$email=$_POST["email"];
$admin=$_POST["admin"];

if (!empty($tunnus))
{
//tästä alkaa empty

if ($submit=="Tallenna" AND $oikat=="1")
{
//tästä alkaa Tallenna
$query = "SELECT * FROM istunto_kayttaja where tunnus = '$tunnus'";
	$tarkistatuplat = mysql_query($query);
	$loytyi=mysql_numrows($tarkistatuplat);

	if (($loytyi > 0) OR $tunnus =="") {
		
		echo "Tunnus on jo olemassa, anna uusi. ";
	}
else{
$kysely = "INSERT INTO istunto_kayttaja (tunnus, salasana, email, admin) VALUES ('$tunnus', '$salasana', '$email', '$admin')";
}
$haku =mysql_query($kysely, $link);

if(!$haku)
die ("Tietojen lis&auml;&auml;minen tietokantaan ei onnistunut" .mysql_error());
}

if($oikat!=1)
echo "<FONT COLOR=red>Sinulla ei ole oikeuksia lis&auml;t&auml; tai poistaa k&auml;ytt&auml;ji&auml;.</FONT COLOR=red>";

if($haku)
{
print "K&auml;ytt&auml;j&auml; lis&auml;tty tietokantaan nimell&auml;: $tunnus";
}
//tähän päättyy tallenna

if ($submit=="Poista" AND $oikat=="1")
{
//tästä alkaa poista
$kysely2 = "DELETE FROM istunto_kayttaja WHERE tunnus='$tunnus'";

$query2 =mysql_query($kysely2, $link);

if(!$query2)
die ("Tietojen poistaminen tietokannasta ei onnistunut".mysql_error());
}
if($query2)
{
print "K&auml;ytt&auml;j&auml; poistettu tietokannasta nimell&auml;: $tunnus";
}
}

include "dbsulje.php";

?>
</div>