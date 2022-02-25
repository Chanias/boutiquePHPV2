<?php
session_start();
include ('header.php');
include ('functions.php');

?>

<body>
 

    <main>
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