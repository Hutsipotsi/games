<?php 
ini_set("display_errors", "off");
$uudestaan =intval($_GET["uudestaan"]);
//ottaa muuttujan lomakkeen lopusta. 
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi" >
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Kirjaudu istuntoon</title>
	<link rel="stylesheet" type="text/css" href="tyylit.css"/>
	<link rel="SHORTCUT ICON" href="../kuvat/logo.jpg"/>
</head>

<body bgcolor="#8F8FBD">

<center>
<table cellpadding="3" bgcolor="lightsteelblue">

<tr><td class="bodyText" colspan="3" bgcolor="white"  height="20"><b>Kirjaudu istuntoon</b></td>


<form action="tarkista_kayttaja.php" method="post">

<td class="bodyText">K&auml;ytt&auml;j&auml;tunnus:</td> <td><input type="text" name="username" size="15"></td></tr>

<tr><td class="bodyText">Salasana:</td> <td><input type="password" name="password" size="15"></td>

<td><br/><input type="submit" value="Kirjaudu" name="B1"></td><tr height="5">

<td class="bodyText" colspan="3" align="center" bgcolor="white"/></tr>


<?php	
	if ($uudestaan == "1") {
		echo "Tunnus tai salasana ei sovi tietokantaan!!";
	} 
?>

</table>
</form>
</center>

</body>

</html>
