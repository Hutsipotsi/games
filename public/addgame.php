<?php

/**
 * A page for inserting, deleting, and updating games in the database.
 */

include TEMPLATES_DIR . 'header.php';
include TEMPLATES_DIR . 'dropdowns.php';
include MODULES_DIR . 'managegame.php';

$pelin_id = filter_input(INPUT_POST, "edit");
if (!isset($pelin_id)) $pelin_id = filter_input(INPUT_POST, "update");
if (!isset($pelin_id)) $pelin_id = filter_input(INPUT_POST, "delete");
$pelin_nimi = filter_input(INPUT_POST, "pelin_nimi", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$tyylilajit = array(); //= filter_input(INPUT_POST, "tyylilajit");
if(isset($_POST['tyylilajit'])) {
    foreach ($_POST['tyylilajit'] as $tyylilaji) array_push($tyylilajit, $tyylilaji);
}
$ikasuositus = filter_input(INPUT_POST, "ikasuositus", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$konsolitunniste = filter_input(INPUT_POST, "konsolitunniste");

//To make konsoli-dropdown show correct default selected value when there's no game to be updated.
if ($konsolitunniste == -1) $konsolitunniste = null;

if (isset($_POST['save'])) {
    addGame($pelin_nimi, $tyylilajit, $ikasuositus, $konsolitunniste);
    echo '<div class="alert alert-success" role="alert">Peli ' . $pelin_nimi . ' lisätty tietokantaan.</div>';
} else if (isset($_POST['edit'])) {
    $pelin_nimi = fetchGameName($pelin_id);
    $tyylilajit = fetchGenres($pelin_id);
    $ikasuositus = fetchAgeRating($pelin_id);
    $konsolitunniste = fetchConsoleID($pelin_id);
} else if (isset($_POST['update']) && isset($pelin_id)) {
    updateGame($pelin_id, $pelin_nimi, $tyylilajit, $ikasuositus, $konsolitunniste);
    echo '<div class="alert alert-success" role="alert">Pelin ' . $pelin_nimi . ' tiedot päivitetty.</div>';
} else if (isset($_POST['delete']) && isset($pelin_id)) {
    removeGame($pelin_id);
    echo '<div class="alert alert-success" role="alert">Peli ' . $pelin_nimi . ' poistettu tietokannasta.</div>';
} else if (isset($_POST['clear'])) header('Location: addgame.php');

if (!isset($pelin_id)) echo '<h4>Lisää peli</h4>';
else echo '<h4>Päivitä peli</h4>';

?>

<form action="addgame.php" method="post">
    <?php

    if (isset($pelin_id)) {
        echo '<div class="form-group mb-2">';
        echo '<label for="peli_id" class="col-sm-1 col-form-label">Pelin ID: </label>';
        echo '<input type="number" name="peli_id" id="peli_id" value="' . $pelin_id . '" disabled/>';
        echo '</div>';
    }

    ?>
    <div class="form-group mb-2">
        <label for="pelin_nimi" class="col-sm-1 col-form-label">Pelin nimi: </label>
        <?php

        if (isset($pelin_id)) {
            echo '<input type="text" name="pelin_nimi" id="pelin_nimi" value="' . $pelin_nimi . '">';
        } else {
            echo '<input type="text" name="pelin_nimi" id="pelin_nimi" placeholder="Peli">';
        }

        ?>
    </div>
    <div class="form-group mb-2">
        <?php createGenreDropdown($tyylilajit); ?>
    </div>
    <div class="form-group mb-2">
        <label for="ikasuositus" class="col-sm-1 col-form-label">Ikäsuositus: </label>
        <?php

        if (isset($pelin_nimi)) {
            echo '<input type="number" name="ikasuositus" id="ikasuositus" value="' . $ikasuositus . '" min="0" max="18" step="1">';
        } else {
            echo '<input type="number" name="ikasuositus" id="ikasuositus" value="0" min="0" max="18" step="1">';
        }

        ?>
    </div>
    <div class="form-group mb-2">
        <?php createConsoleIdDropdown($konsolitunniste); ?>
    </div>
    <div class="form-group mb-2">
        <?php
        
        if (!isset($pelin_id)) {
            echo '<button type="submit" name="save" value="save" class="btn btn-primary" >Lisää</button>';
        } else {
            echo '<button type="submit" name="update" value="' . $pelin_id . '" class="btn btn-primary">Päivitä</button>';
            echo '<button type="submit" name="clear" value="clear" class="btn btn-secondary">Tyhjennä</button>';
            echo '<br><button type="submit" name="delete" value="' . $pelin_id . '" class="btn btn-secondary">Poista tietokannasta</button>';
        }
        
        ?>
    <div>
    <button type="submit" name="search" value="search" class="btn btn-secondary">Hae nimellä</button>
</form>

<?php

if (isset($pelin_nimi) && !empty($pelin_nimi) && isset($_POST['search']) && $_POST['search']) {
    searchByName($pelin_nimi);
}

include TEMPLATES_DIR . 'footer.php';

// EOF