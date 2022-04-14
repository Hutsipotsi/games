<?php
include TEMPLATES_DIR.'header.php';

?>

<h3>Lisää peli</h3>

<form>
    <div class="form-group row">
        <label for="pelin_nimi">Pelin nimi: </label>
        <input type="text" class="form-control" id="pelin_nimi" placeholder="Lisää nimi">
    </div>
    <div class="form-group row">
        <label for="tyylilajit">Tyylilajit: </label>
        <select id="tyylilajit" class="selectpicker" multiple>
            <option>Banaani</option>
            <option>Omena</option>
        </select>
    </div>

</form>

<?php
//Pelin nimi Text field

//Tyylilaji Bootstrap dropdown selectpicker

//Ikäsuositus number field

//Konsolitunniste DROPDOWN from data

//Lisää BUTTON
?>

<?php   include TEMPLATES_DIR.'footer.php'; ?>