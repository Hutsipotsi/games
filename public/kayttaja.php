<?php

include TEMPLATES_DIR . 'header.php';
include MODULES_DIR . 'addkayttaja.php';


    $uname = filter_input(INPUT_POST, "tunnus");
    $email = filter_input(INPUT_POST, "email");
    $oikat = filter_input(INPUT_POST, "oikat");
    $pw = filter_input(INPUT_POST, "password");

    if(isset($uname)){
        try{
            addPerson($uname, $email, $oikat, $pw);
            echo '<div class="alert alert-success" role="alert">Person added!!</div>';
        }catch(Exception $e){
            echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';

        }
      }
?>

<form method="post">
<div class="form-group row">
  <label for="tunnus" class="col-sm-2 col-form-label">Käyttäjätunnus</label>
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
  <label for="email" class="col-sm-2 col-form-label">Sähköposti</label>
  <div class="col-sm-4">
    <input type="email" name="email" class="form-control" id="email" placeholder="Sähköposti">
  </div>
</div>
<div class="form-group row">
  <label for="password" class="col-sm-2 col-form-label">Salasana</label>
  <div class="col-sm-4">
    <input type="password" name="password" class="form-control" id="password" placeholder="Salasana">
  </div>
</div>
<div class="form-group row">
  <label for="oikat" class="col-sm-2 col-form-label">Käyttöoikeustaso</label>
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
    <button type="submit" value="tallenna" class="btn btn-primary">Tallenna</button>
    <button type="submit" value="poista" class="btn btn-primary">Poista</button>
  </div>
</div>
</form>
 