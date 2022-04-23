<?php
include TEMPLATES_DIR . 'header.php';
include MODULES_DIR . 'authorization.php';


$uname = filter_input(INPUT_POST, "tunnus");
$pass = filter_input(INPUT_POST, "salasana");
$admin = filter_input(INPUT_POST, "oikat");

if (!isset($_SESSION["tunnus"]) && isset($uname)) {

    try {
        login($uname, $pass, $admin);
        header("Location: peli.php");
        exit;
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">' . $e->getMessage() . '</div>';
    }
}

if (!isset($_SESSION["tunnus"])) {
?>

    <form action="login.php" method="post">
    <div class="form-group row">
        <label for="tunnus" class="col-sm-1 col-form-label">Tunnus:</label>
        <div class="col-sm-4">
        <input type="text" name="tunnus" id="tunnus">
        </div>
    </div>
    <div class="form-group row">
        <label for="salasana" class="col-sm-1 col-form-label">Salasana:</label>
        <div class="col-sm-4">
        <input type="password" name="salasana" id="salasana">
        </div>
        <div class="form-group row">
        <input type="submit" class="btn btn-secondary col-sm-1 col-form-label" value="Kirjaudu">
        </div>
    </div>
    </form>


<?php } include TEMPLATES_DIR . 'footer.php'; ?>