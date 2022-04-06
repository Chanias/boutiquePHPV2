<?php
session_start();
include ('header.php');
include ('functions.php');

?>
<main>
     <div class="container-fluid pb-3">
            <div class="row text-center">
                <div class="image" id="image_et_titre">
                <h1>Les PC GAMERS</h1>
            </div>
        </div> 
<div class="container mt-3 text-center">
            <h3>Mes commandes</h3>
        </div>

        <div class="container-fluid p-5">
            <div class="row text-center justify-content-center">
                <?php 
                showCommandes();
                 ?>
            </div>
        </div>

        <div class="container text-center">
            <a href="profil.php">
                <button class="btn btn-dark">Retour au compte</button>
            </a>
        </div>

<?php
include ('footer.php');
     ?>