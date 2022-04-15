<?php

require '../../src/templates/header.php';
include '../../src/modules/kayttaja.php';




    $uname = filter_input(INPUT_POST, "tunnus");
    $email = filter_input(INPUT_POST, "email");
    $oikat = filter_input(INPUT_POST, "admin");
    $pw = filter_input(INPUT_POST, "password");

    if(isset($uname)){
        try{
            addPerson($uname, $email, $oikat, $pw);
            echo '<div class="alert alert-success" role="alert">Person added!!</div>';
        }catch(Exception $e){
            echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';

        }
      }
/* $pdo = getPdoConnection();


echo '<strong>Käyttäjätunnus:</strong> &nbsp;&nbsp;<input type ="text" name="tunnus"/><br/>';

echo '<strong>Salasana:</strong> &nbsp;&nbsp;<input type ="text" name="password"/><br/>';

echo '<strong>Sähköposti:</strong> &nbsp;&nbsp;<input type ="text" name="email"/><br/>';

//Haetaan valikkoon tunnistenumero
$sql = "SELECT admin FROM istunto_kayttaja";

$oikat = $pdo->query($sql);

    if ($oikat->rowCount() > 0) {
        echo '<label for="admin">Käyttöoikeus nro:</label>
    <select name="admin">';

        foreach ($oikat as $row) {
            echo '<option value="' . $row["admin"] . '">' . $row["admin"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select><br/>';
    }
echo '<br/>';

echo '<input type="submit" name="tallenna" value="Tallenna"/>';
echo '<input type="submit" name="poista" value="Poista"/>'; */

?>

<form method="post">
    <div class="col-auto">
        <label for="tunnus" class="sr-only">Käyttäjätunnus</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text">@</div>
          </div>
          <input type="text" name="tunnus" id="tunnus" class="form-control" id="inlineFormInputGroup" placeholder="Username">
        </div>
      </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Salasana</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    </div>
  </div>
  <select for="admin" class="custom-select"name="admin" id="admin">
  <option selected>Valitse oikeustaso</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" value="tallenna" class="btn btn-primary">Tallenna</button>
      <button type="submit" value="poista" class="btn btn-primary">Poista</button>
    </div>
  </div>
</form>
 
<?php

require '../../src/modules/header.php';
require 'db.php';

 $pdo = getPdoConnection();


echo '<strong>Käyttäjätunnus:</strong> &nbsp;&nbsp;<input type ="text" name="tunnus"/><br/>';

echo '<strong>Salasana:</strong> &nbsp;&nbsp;<input type ="text" name="salasana"/><br/>';

echo '<strong>Sähköposti:</strong> &nbsp;&nbsp;<input type ="text" name="email"/><br/>';

//Haetaan valikkoon tunnistenumero
$sql = "SELECT oikat FROM istunto_kayttaja";

$oikat = $pdo->query($sql);

    if ($oikat->rowCount() > 0) {
        echo '<label for="oikat">Käyttöoikeus nro:</label>
    <select name="oikat">';

        foreach ($oikat as $row) {
            echo '<option value="' . $row["oikat"] . '">' . $row["oikat"] . '</option>';
        }
        echo '<option value="Valitse" selected="selected">Valitse</option></select><br/>';
    }
echo '<br/>';

echo '<input type="submit" name="tallenna" value="Tallenna"/>';
echo '<input type="submit" name="poista" value="Poista"/>';

?>