<?php
include('header.php');
include('functions.php');
session_start();

?>
<main>
    <div class="container-fluid pb-3">
        <div class="row text-center">
            <div class="image" id="image_et_titre">
                <h1>Les PC GAMERS</h1>
            </div>
        </div>

        <!--Les onglets du compte -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Mon compte</h2>
                </div>
            </div>
        </div>

        <div class="row text-center ml-2 mr-2 mt-5">
        <div class="col-md-3">
        <i class="fa-solid fa-user mb-2 fa-3x"></i>
                <form action="modifInfos.php">
                    <button type="submit" class="btn btn-primary text-center mx-auto mt-2">Modifier mes informations</button>
                </form>
            </div>


            <div class="col-md-3">
            <i class="fa-solid fa-key mb-2 fa-3x"></i>
                <form action="modifMdp.php">
                    <button type="submit" class="btn btn-primary text-center mx-auto mt-2">Modifier mon mot de passe</button>
                </form>
            </div>

            <div class="col-md-3">
            <i class="fa-solid fa-location-dot mb-2 fa-3x"></i>
                <form action="modifAdresse.php">
                    <button type="submit" class="btn btn-primary text-center mx-auto mt-2">Modifier mon adresse</button>
                </form>
            </div>
            <div class="col-md-3">
            <i class="fa-solid fa-ticket mb-2 fa-3x"></i>
                <form action="commandes.php">
                    <button type="submit" class="btn btn-primary text-center mx-auto mt-2">Voir mes commandes</button>
                </form>
            </div>

        </div>
        <?php
        include('footer.php');
        ?>