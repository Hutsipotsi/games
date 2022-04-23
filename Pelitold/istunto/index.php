<?php
//poistaa virheilmoitukset
 	error_reporting(E_ALL);
 	ini_set("display_errors", "on");
	//*********** 
	
session_start();

//onko muuttujaan annettu arvo vai ei
if (!isset($_SESSION['username']))
 {
header("Location: login.php?uudestaan=0");

//lähettää kirjautumissivun ennen varsinaista index-sivua 
}
?>
<?php $userid = $_SESSION['userid']; $oikat= $_SESSION['oikat']; ?>

<?php
include TEMPLATES_DIR . 'header.php';
include TEMPLATES_DIR . 'dropdowns.php';
include MODULES_DIR . 'addgame.php';

echo'<div id="linkit"><pre><span style="font-family:Arial"><a href="?p=c_etusivu">Etusivu</a>     <a href="?p=c_hae">Pelit ja konsolit</a>     <a href="?p=c_lisaa">Lisää pelejä</a>     <a href="?p=c_elokuvat">Elokuvat</a>     <a href="?p=c_lisaaelokuva">Lis&auml;&auml; elokuvia</a>     <a href="?p=c_kayttajat">K&auml;ytt&auml;j&auml;tunnukset</a>     <a href="kirjaudu_ulos.php"> Kirjaudu ulos</a></span></pre>Tervetuloa'?> <?php echo $_SESSION['username']; ?>

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