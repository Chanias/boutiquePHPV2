<?php
session_start();
include ('header.php');
include ('functions.php');
?>
<body>
<main>
    <?php
  // var_dump pour tester si ça fonctionne
  if(isset($_POST['articleId'])){
      $article = getArticleFromId($_POST['articleId']);
  ajoutArticle($article);
  }
  if(isset($_POST['supprimerArticle'])){  
      supprimerArticle($_POST['supprimerArticle']);
  }

if (isset($_POST['quantite'])){
  modifQuantite($_POST['quantite'], $_POST["id_article"]);
  }
  if (isset($_POST['vider_panier'])){
      viderPanier($_POST['vider_panier']);
      }
  if (isset($_POST["modif_infos"])) {
    modifInfos();
}

if (isset($_POST["modif_adresse"])) {
    modifAdresse();
}
  
  
   ?>

<div class="row justify-content-center text-dark font-weight-bold bg-dark p-4">
<?php
   afficherPanier("validation.php"); 
?>
</div>
<div class="row justify-content-center text-dark font-weight-bold bg-light p-4">
                <?php
                    afficherTotal();
                ?>
</div>   
    <div class="row justify-content-center text-dark font-weight-bold bg-light p-4">
                <?php
                    afficherFraisDePort();
                ?>
    </div> 
   
    <!-- AFFICHER ICI LA FUNCTION MODIFICATION INFORMATION et MODIF ADRESSE-->
<?php
echo '<h3 class="text-center">Adresse de livraison</h3>';
showModifInfos("validation.php");
showModifAdresse("validation.php");
?>

<?php
echo '<h3 class="text-center">Adresse de facturation</h3>';
showModifAdresse("validation.php");
?>
        <div class="row justify-content-center text-dark font-weight-bold bg-light p-4">
                <?php
                    afficherTotalApresFdp();
                ?>
        </div>  

<!--BOUTON DU MODAL -->    
<button type="button" class="btn btn-success d-flex justify-content-center mx-auto text-center mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Confirmer la commande
</button>
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: green" id="exampleModalLabel">Votre commande à été validée</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="marge intérieure" style="line-height: 4;">
                    <?php
                    afficherTotalApresFdp();
                    echo "<br>" . " La commande sera expédié le : ";
                    // passage au fuseau horaire français
                     setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); 
                    // récupère date du jour (2021-12-23)
                    $date = date("Y-m-d");   
                    echo utf8_encode(strftime("%A %d %B %Y", strtotime($date . " + 3 days")));
                    echo "<br>" . " Livraison prévue le : ";
                    echo utf8_encode(strftime("%A %d %B %Y", strtotime($date . " + 5 days")));
                    echo "<br>" . " Merci et à bientôt";
                    ?>
                </div>
            </div>

            <div class="modal-footer text-center mx-auto">
                <form action="index.php" method="POST">
                    <input type="hidden" name="commande-valide">
                    <button type="submit" class="btn btn-primary text-center mx-auto">Retour à l'acceuil</button>
                </form>
            </div>

        </div>
    </div>
</div>  
       
</main>

     <?php
include ('footer.php');
     ?>
</body>
</html>