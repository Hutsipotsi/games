<?php

include MODULES_DIR . 'tarkistakayttaja.php';

session_start();
session_unset();
session_destroy();

if(isset($_SESSION["tunnus"])){
    logout();
    header("Location: kirjaaulos.php");
}else{
    echo '<div class="alert alert-success" role="alert">Logged out!!</div>';
    header("Location: pelit.php");
}
?>