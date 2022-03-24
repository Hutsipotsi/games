<?php

session_start();

ini_set("display_errors", "on");
$uudestaan =intval($_GET["uudestaan"]);
//ottaa muuttujan lomakkeen lopusta. 
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi" >
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Kirjaudu sisään</title>
	<link rel="stylesheet" type="text/css" href="tyylit.css"/>
	<link rel="SHORTCUT ICON" href="../kuvat/logo.jpg"/>
</head>

<body><div id="kirjaa">
<form action="tarkista_kayttaja.php" method="post">
<pre><span style="font-family:times new romain"><b>Kirjaudu sisään</b><br/><br/>
K&auml;ytt&auml;j&auml;tunnus: <input type="text" name="username" size="15"/><br/>
Salasana:	       <input type="password" name="password" size="15"/><br/> 
<input type="submit" value="Kirjaudu" name="submit"/>
</span> </pre>
 </form>
<?php	
	if ($uudestaan == "1") {
		echo "Tunnus tai salasana v&auml;&auml;rin!!";
	} 
?>
</div> 
</body>
</html>
