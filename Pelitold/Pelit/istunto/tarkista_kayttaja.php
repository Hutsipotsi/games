<?php
ini_set("display_errors", "off");

session_start();
$uudestaan = 0;

include "yhteys.php";

$login = mysql_query("select * from istunto_kayttaja where (tunnus = '" . $_POST['username'] . "') and (salasana = '" . ($_POST['password']) . "')",$link);


	while ($newArray = mysql_fetch_array($login)) {
	$id =    $newArray['id'];
    $oikat = $newArray['admin'];
	}
	
$rowcount = mysql_num_rows($login);

if ($rowcount == 1) {
			

	$_SESSION['username'] = $_POST['username'];
	$_SESSION['admin'] = $oikat;
	$_SESSION['userid'] = $id;

header('Location: index.php');

}

else

{
	
header('Location: kirjautumis_sivu.php?uudestaan=1');

}

?>
