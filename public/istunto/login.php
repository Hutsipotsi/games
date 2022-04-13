<?php
include  '../../src/templates/header.php';
include '../../src/modules/authorization.php';

$uname = filter_input(INPUT_POST, "tunnus");
$pass = filter_input(INPUT_POST, "salasana");

if (!isset($_SESSION["tunnus"]) && isset($uname)) {

    try {
        login($uname, $pass);
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">' . $e->getMessage() . '</div>';
    }
}

if (!isset($_SESSION["tunnus"])) {
?>

    <form action="login.php" method="post">
        <label for="tunnus">Tunnus:</label><br>
        <input type="text" name="tunnus" id="tunnus"><br>
        <label for="salasana">Salasana:</label><br>
        <input type="password" name="salasana" id="salasana"><br>
        <input type="submit" class="btn btn-primary" value="Log in">
    </form>


<?php } ?>