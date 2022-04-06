<?php
session_start();
include ('header.php');
include ('functions.php');

?>

<body>
 

<main>
     <div class="container-fluid pb-3">
            <div class="row text-center">
                <div class="image" id="image_et_titre">
                <h1>Les PC GAMERS</h1>
            </div>
        </div> 
        <?php
        //affichage d'un article avec détails
       // affichage de l'article dans la page détail

     $article = getArticleFromId($_POST['articleId']);
     showArticlesDetails($article);
     ?>
 <form class="text-center mb-2" action="panier.php" method="post">
        <input type="hidden" name="articleId" value="<?=$article['id'] ?>">
        <input class="btn btn-primary text-center mx-auto mt-2" type="submit" value="Ajouter au panier">
    </form> 

  
       
    </main>

<?php
include ('footer.php');
?>
</body>

</html>