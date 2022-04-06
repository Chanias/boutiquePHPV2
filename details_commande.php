<?php
session_start();
include ('header.php');
include ('functions.php');

?>

<div class="container mt-3 text-center">
            <h3>Le détails de ma commande</h3>
        </div>

        <div class="container-fluid p-5">
            <div class="row text-center justify-content-center">
                <?php 
                if(isset($_POST['id']));
                showCommandeDetails($_POST['id']);
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