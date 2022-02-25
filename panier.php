<?php
session_start();
include ('header.php');
include ('functions.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
     ?>
      <div class="row justify-content-center text-dark font-weight-bold bg-light p-4">
                <?php
                   afficherPanier("panier.php"); 
                ?>
            </div>

   
    <div class="row justify-content-center text-dark font-weight-bold bg-light p-4">
                <?php
                    afficherTotal();
                ?>
            </div>
<div class="row justify-content-center text-dark font-weight-bold bg-light p-4">            
<form class="text-center mb-2" action="panier.php" method="post">
<button class="btn btn-danger" name="vider_panier" type="submit">Vider le panier</button>
</form> 
<form class="text-center mb-2" action="validation.php" method="post">
<button class="btn btn-success" name="valider_panier" type="submit">Valider le panier</button>
</form> 
</div>           
            
            
    </main>
    <?php
include ('footer.php');
    ?>
</body>
</html>
