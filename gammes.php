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
     <section id="cards">
  <div class="row">
    <?php
affichGammes();
    ?>
  
</div>
</section>
       
       
       <!--LES ARTICLES DANS DES CARDS PAR GAMMES-->
 
    </main>

    <?php
    include('footer.php');
    ?>
</body>
</html>