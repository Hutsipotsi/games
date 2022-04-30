<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>Pelit</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="peli.php">Etusivu</a>
                    </li>
                    <li class="nav-item">

                        <?php
                        if (!isset($_SESSION["tunnus"])) {
                            echo '<a class="nav-link bg-dark" href="login.php">Kirjaudu sisään</a>';
                        } else {
                          ?>
                            <li class="nav-item">
                                 <a class="nav-link" href="../public/addkayttaja.php">Lisää käyttäjä</a>
                             </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="addgame.php">Lisää peli</a>
                             </li>
                         <?php
                              echo '<a class="nav-link bg-dark" href="logout.php">Kirjaudu ulos</a>';
                        }
                        ?>
                    </li>
                    </ul>                
            </div>
            <?php  if (isset($_SESSION["tunnus"])) { echo '<div class="welcome">Tervetuloa ' .$_SESSION['tunnus'].'</div>';}?> 
        </div>
    </nav>