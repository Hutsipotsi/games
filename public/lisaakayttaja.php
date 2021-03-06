<?php

include TEMPLATES_DIR . 'header.php';
include MODULES_DIR . 'lisaakayttaja.php';

    $uname = filter_input(INPUT_POST, "tunnus");
    $email = filter_input(INPUT_POST, "email");
    $oikat = filter_input(INPUT_POST, "oikat");
    $pw = filter_input(INPUT_POST, "password");
    $tallenna = filter_input(INPUT_POST, "tallenna");
    $poista = filter_input(INPUT_POST, "poista");

    
?>
<div class=container>

<h4>Lisää käyttäjä</h4>

<form method="post" id="kayttaja">
<div class="form-group row">
  <label for="tunnus" class="col-sm-2 col-form-label">Käyttäjätunnus:</label>
  <div class="col-sm-2">
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">@</div>
      </div>
      <input type="text" name="tunnus" id="tunnus" class="form-control" id="inlineFormInputGroup" placeholder="Käyttäjätunnus">
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="email" class="col-sm-2 col-form-label">Sähköposti:</label>
  <div class="col-sm-4">
    <input type="email" name="email" class="form-control" id="email" placeholder="Sähköposti">
  </div>
</div>
<div class="form-group row">
  <label for="password" class="col-sm-2 col-form-label">Salasana:</label>
  <div class="col-sm-4">
    <input type="password" name="password" class="form-control" id="password" placeholder="Salasana">
  </div>
</div>
<div class="form-group row">
  <label for="oikat" class="col-sm-2 col-form-label">Käyttöoikeustaso:</label>
    <div class="col-sm-2 col-form-label">
      <select for="oikat" class="custom-select" name="oikat" id="oikat">
        <option selected>Valitse oikeustaso</option>
        <option value="1">Admin</option>
        <option value="2">Käyttäjä</option>
        <option value="3">Katselija</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
  <div class="col-sm-2">
    <button type="submit" name="tallenna" id="lktallenna" value="tallenna" class="btn btn-primary">Tallenna</button>
    <button type="poista" name="poista" id="lkpoista" value="poista" class="btn btn-primary">Poista</button>
  </div>
</div>
</form>
</div>
<?php include TEMPLATES_DIR . 'footer.php'; ?>
 