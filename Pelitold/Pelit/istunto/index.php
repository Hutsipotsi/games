<?php
//poistaa virheilmoitukset
 	error_reporting(E_ALL);
 	ini_set("display_errors", "off");
	//*********** 
	
session_start();

// s.284 onko muuttujaan annettu arvo vai ei
if (!isset($_SESSION['username']))
 {
header("Location: kirjautumis_sivu.php?uudestaan=0");

//lähettää kirjautumissivun ennen varsinaista index-sivua 
}
?>
<?php $userid = $_SESSION['userid']; $oikat= $_SESSION['admin']; ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi" >
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Pelit</title> 
	<link rel="stylesheet" type="text/css" href="../../tyylit.css"/>
	<link rel="SHORTCUT ICON" href="../../kuvat/logo.jpg"/>
</head>
<body>
<h1><br/>Pelit, konsolit ja elokuvat</h1>

<div id="navigation">
<?php include "../../napit.php"; ?>
</div>
<!--<p><a href="http://laksot.fi/index.php"><img src="../kuvat/etusivu.jpg" alt="etusivu" border="0"/></a></p>
<p><a href="../index.php"><img src="../kuvat/portfolio.jpg" alt="portfolio" border="0"/></a></p>
<p><a href="../kuvankasittely.php"><img src="../kuvat/kuvankasittely.jpg" alt="kuvankasittely" border="0"/></a></p>
<p><a href="../pelit.php"><img src="../kuvat/pelit.jpg" alt="pelit" border="0"/></a></p>
<p><a href="../ohjelmointi.php"><img src="../kuvat/ohjelmointi.jpg" alt="ohjelmointi" border="0"/></a></p>
<p><a href="../dokumentit.php"><img src="../kuvat/dokumentit.jpg" alt="dokumentit" border="0"/></a></p>
<p><a href="../verkot.php"><img src="../kuvat/verkot.jpg" alt="verkot" border="0"/></a></p>
<p><a href="../projekti/projekti.php"><img src="../kuvat/projekti.jpg" alt="projekti" border="0"/></a></p>
<img src="../kuvat/PoweredByMacOSX.gif" alt="logo"/>
<div id="navigation2"><p>
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" border="0" /></a>
  </p>
<?php
echo "Sivua on p&auml;ivitetty viimeksi: " . date ("d.m.Y H:i:s", getlastmod());
?>-->
</div>
</div>
<div id="linkit"><pre><span style="font-family:Arial"><a href="?p=c_etusivu">Etusivu</a>     <a href="?p=c_hae">Pelit ja konsolit</a>     <a href="?p=c_lisaa">Lis&auml;&auml; pelej&auml;</a>     <a href="?p=c_elokuvat">Elokuvat</a>     <a href="?p=c_lisaaelokuva">Lis&auml;&auml; elokuvia</a>     <a href="?p=c_kayttajat">K&auml;ytt&auml;j&auml;tunnukset</a>     <a href="kirjaudu_ulos.php"> Kirjaudu ulos</a></span></pre><div id="nimip">Tervetuloa <?php echo $_SESSION['username']; ?>
</div></div>


<?php
if (isset($_GET['p'])) {
 	switch($_GET['p']) {

	case'c_etusivu':
	
	include('etusivu.php');
	break;
	
	case'c_hae':
	include('kyselyt_pelit.php' );
	break;
	
	case'c_lisaa':
	include('lisaa_peli.php' );
	break;
	
	case'c_kayttajat':
	include('kayttajat.php' );
	break;
	
	case'c_elokuvat':
	include('elokuvat.php' );
	break;
	
	case'c_lisaaelokuva':
	include('lisaa_elokuva.php' );
	break;
	
   }
}else include('etusivu.php' );
?>

<div id="laskuri">
©ELakso 2010</div>


</body>
</html>