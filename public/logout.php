<?php

include '../src/modules/authorization.php';

session_start();
session_unset();
session_destroy();

if(isset($_SESSION["tunnus"])){
    logout();
    header("Location: logout.php");
}else{
    echo '<div class="alert alert-success" role="alert">Logged out!!</div>';
}
?>