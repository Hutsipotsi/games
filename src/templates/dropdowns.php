<?php

include MODULES_DIR . 'dropdown_data.php';

function createGenreDropdown($tyylilajit)
{

    $genres = getGenres();

    echo '<label for="tyylilajit" class="col-sm-1 col-form-label">Tyylilajit: </label>';
    echo '<select name="tyylilajit[]" id="tyylilajit" class="selectpicker" multiple title="Valitse...">';
    foreach ($genres as $genre) {
        echo '<option value="' . $genre["id"];
        if (isset($tyylilajit) && in_array($genre['id'], $tyylilajit)) {
            echo '" selected>' . $genre["tyylilaji"] . '</option>';
        } else echo '">' . $genre["tyylilaji"] . '</option>';
    }
    echo '</select>';
}

function createConsoleIdDropdown($konsolitunniste)
{

    $consoleIDs = getConsoleIDs();

    echo '<label for="konsolitunniste" class="col-sm-1 col-form-label">Konsoli: </label>';
    echo '<select name="konsolitunniste" id="konsolitunniste" class="dropdown">';
    if (!isset($konsolitunniste) && empty($konsolitunniste)) {
        echo '<option value="-1" selected>Valitse...</option>';
    }
    foreach ($consoleIDs as $consoleID) {
        echo '<option value="' . $consoleID["id"];
        if (isset($konsolitunniste) && $consoleID["id"] == $konsolitunniste) {
            echo '" selected>' . $consoleID["malli"] . '</option>';
        } else echo '">' . $consoleID["malli"] . '</option>';
    }
    echo '</select>';
}

// EOF