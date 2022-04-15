<?php
    include MODULES_DIR.'dropdown_data.php';

function createGenreDropdown() {

    $genres = getGenres();

    echo '<label for="tyylilajit">Tyylilajit: </label>';
    echo '<select name="tyylilajit" id="tyylilajit" class="selectpicker" multiple title="Valitse...">';
    foreach($genres as $genre) {
        echo '<option value="' . $genre["id"] . '">' . $genre["tyylilaji"] . '</option>';
    }
    echo '</select>';

}

function createConsoleIdDropdown() {

    $consoleIDs = getConsoleIDs();

    echo '<label for="konsolitunniste">Konsoli: </label>';
    echo '<select name="konsolitunniste" id="konsolitunniste" class="dropdown">';
    foreach($consoleIDs as $consoleID) {
        echo '<option value="' . $consoleID["id"] . '">' . $consoleID["malli"] . '</a>';
    }
    echo '</select>';

}

?>