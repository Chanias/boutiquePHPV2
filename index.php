<!DOCTYPE html>
<html lang="en">

<body>
<?php
session_start();
    
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
    if (isset($_POST['inscription'])) {
        inscription();
    }
    if (isset($_POST['connexion'])) {
        connexion();
    }
    if (isset($_POST['deconnexion'])) {
        deconnexion();
    }
    include('header.php');
?> 

     <main>
     <div class="container-fluid pb-3">
            <div class="row text-center">
                <div class="image" id="image_et_titre">
                <h1>Les PC GAMERS</h1>
            </div>
        </div> 
       
       
       <!--LES ARTICLES DANS DES CARDS-->
  <section id="cards">
<h2>Nos produits</h2>
  <div class="row">
    <?php
    $articles = getArticles();
show_articles($articles);
    ?>
</div>
</section>

    </main>

    <?php
    include('footer.php');
    ?>
</body>
</html>