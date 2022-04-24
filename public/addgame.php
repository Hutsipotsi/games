<?php
include TEMPLATES_DIR . 'header.php';
include TEMPLATES_DIR . 'dropdowns.php';
include MODULES_DIR . 'addgame.php';

$pelin_nimi = filter_input(INPUT_POST, "pelin_nimi", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$tyylilajit[] = filter_input(INPUT_POST, "tyylilajit");
$ikasuositus = filter_input(INPUT_POST, "ikasuositus", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$konsolitunniste = filter_input(INPUT_POST, "konsolitunniste");
    
if(isset($pelin_nimi)) {
    addGame($pelin_nimi, $tyylilajit, $ikasuositus, $konsolitunniste);
    echo '<div class="alert alert-success" role="alert">Peli ' .$pelin_nimi. ' lisätty tietokantaan.</div>';
}

?>

<h4>Lisää peli</h4>

<form action="addgame.php" method="post">
    <div class="form-group mb-2">
        <label for="pelin_nimi" class="col-sm-1 col-form-label">Pelin nimi: </label>
        <input type="text" name="pelin_nimi" id="pelin_nimi" placeholder="Peli">
    </div>
    <div class="form-group mb-2">
        <?php createGenreDropdown(); ?>
    </div>
    <div class="form-group mb-2">
        <label for="ikasuositus" class="col-sm-1 col-form-label">Ikäsuositus: </label>
        <input type="number" name="ikasuositus" id="ikasuositus" value="0" min="0" max="18" step="1">
    </div>
    <div class="form-group mb-2">
        <?php createConsoleIdDropdown(); ?>
    </div>
    <button type="submit" name="tallenna" value="tallenna" class="btn btn-secondary" >Lisää</button>
    <button type="submit" name="poista" value="poista" class="btn btn-secondary">Poista</button>
    <button type="submit" name="update" value="update" class="btn btn-secondary">Päivitä</button>
</form>

<?php include TEMPLATES_DIR . 'footer.php'; ?>