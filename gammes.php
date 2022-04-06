<!DOCTYPE html>
<html lang="en">

<body>
<?php
session_start();
    include('header.php');
    include ('functions.php');
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier']=[];
        // ou  $_SESSION['panier']=array();
        //pour créer un panier vide
        //! l'inverse d'une variable donc si il n'existe pas je créer
    }
    if (isset($_POST['commande-valide'])){
      viderPanier();
    }
?> 

<main>
     <div class="container-fluid pb-3">
            <div class="row text-center">
                <div class="image" id="image_et_titre">
                <h1>Les PC GAMERS</h1>
            </div>
        </div> 
     <section id="cards">
  <div class="row">
      <!--LES ARTICLES DANS DES CARDS PAR GAMMES-->
    <?php
affichGammes();
    ?>
  
</div>
</section>
       
       
       
 
    </main>

    <?php
    include('footer.php');
    ?>
</body>
</html>