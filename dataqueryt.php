<?php

//$submit=$_POST["submit"];

if(!empty($_POST["pelikonsolit"]))
{
//tästä alkaa Hae

if (($_POST["pelikonsolit"]!="Valitse" ) && ($_POST["pelit_konsoli"]=="Valitse") && ($_POST["pelit_valmistaja"]=="Valitse") && ($_POST["pelit_tyyli"]=="Valitse"))
{
$pelikonsoli=$_POST["pelikonsolit"];
if ($pelikonsoli=="Kaikki")
{
$kysely = "SELECT tekija AS valmistaja, konsoli As malli, kpl, vari FROM kasikonsolit UNION ALL SELECT valmistaja, malli, kpl, vari FROM pelikonsolit ORDER BY valmistaja, malli asc;";
}

elseif ($pelikonsoli=="kasikonsolit")
{
$kysely = "SELECT tekija AS valmistaja, konsoli AS malli, kpl, vari FROM kasikonsolit";
}

else {
$kysely = "SELECT valmistaja, malli, kpl, vari FROM pelikonsolit WHERE valmistaja='$pelikonsoli'";
}

$haku =mysqli_query($kysely);
echo "<br/><table border cellpadding=5>";
echo "<tr><td><b>valmistaja</b></td><td><b>malli</b></td><td><b>kpl</b></td><td><b>V&auml;ri</b></td></tr>";

for ($i = 0; $i <mysqli_num_rows($haku); $i++) {

   $valmistaja = mysqli_data_seek($haku, $i, "valmistaja");
   $malli = mysqli_data_seek($haku, $i, "malli");
   $kpl =mysqli_data_seek($haku, $i, "kpl");
   $vari = mysqli_data_seek($haku, $i, "vari");
   $tekija = mysqli_data_seek($haku, $i, "valmistaja");
   $konsoli = mysqli_data_seek($haku, $i, "malli");
   //tulostetaan taulukon rivi
   echo "<tr><td>$valmistaja</td><td>$malli</td><td>$kpl</td><td>$vari</td></tr>";
}
echo "</table>";
}
}
?>