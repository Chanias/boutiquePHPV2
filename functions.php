<?php
// Déclaration du tableau d'articles et le retourne

function getArticles(){
    $articles=
    [
[
    "id"=>1,
    "nom"=>"PC gamer razor",
    "description"=>"un pc qui permet de jouer à des jeux plutôt récents... pour les budgets moyens",
    "description_detaille"=>"
        Une carte graphique dédiée est indispensable pour faire du traitement photo ou vidéo, ainsi que pour jouer à des jeux vidéos exigeants en terme de ressources.
        ",
    "prix"=>1499.99,
    "image"=>"razor.jpeg"],
[
    "id"=>2,
    "nom"=>"PC-gamer SKILLKORP",
    "description"=>"Le + : Performance et design à prix contenu, un pc gamers pour les petits budgets",
    "description_detaille"=>"Les points clés
        Processeur : AMD Ryzen 5 3600X
        Carte graphique : Nvidia GeForce GTX 1650 4Go
        Mémoire vive : 8 Go
        Stockage : SSD 512 GoPerformance graphique
        Type de carte graphique : dédiée
        Avantage de la carte graphique dédiée : Une carte graphique dédiée est indispensable pour faire du traitement photo ou vidéo, ainsi que pour jouer à des jeux vidéos exigeants en terme de ressources.
        Modèle : Nvidia GeForce GTX 1650 4Go
        Type de mémoire : GDDR6
        Compatible réalité virtuelle : Oui
        Mémoire : 4 Go",
    "prix"=>899.99,
    "image"=>"SKILLCORP.jpg"],

[
    "id"=>3,
    "nom"=>"PC-gamer INQUISITOR",
    "description"=>"Avec l’inquisitor, vous aurez ici de quoi combattre toutes les situations possibles, qui va vous permettre le gaming le plus acharné qui soit.",
    "description_detaillee"=>"Processeur AMD Ryzen 9 5950xMémoire 32Go DDR4 BallistixCarte graphique RTX 3090Disque SSD 2To NVMe Gen 4Watercooling 360mm RGBWifi intégréWindows
    Caractéristiques
        Boîtier PC Asus ROG Strix Helios GX601 Window - MT/E-ATX
        Processeur AMD Ryzen 9 5950X Tray
        Carte mère Gigabyte X570 AORUS PRO - X570/AM4/ATX
        Mémoire PC Ballistix BL2K16G32C16U4BL RGB (2x16Go DDR4 3200 PC25600)",
    "prix"=>5199.99,
    "image"=>"INQUISITOR.jpg"]
];
    return $articles;
}

// affichage des articles + bouton du détails produit

function show_articles()
{
    $articles = getArticles();

    foreach ($articles as $article) {
// il faut créer comme un formulaire pour le "bouton détails"
        echo '<div class="card mx-auto col-md-4 mb-5" style="width: 20rem;">
  <img src="./ressources/' . $article['image'] . '" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">' . $article['nom'] . '</h5>
    <p class="card-text">' . $article['description'] . '</p>
    <p class="card-text">' . number_format($article['prix'],2,',',' ') . ' €</p>
    
    <form action="produit.php" method="post">
        <input type="hidden" name="articleId" value="'. $article['id'] .'" ">
        <input class="btn btn-light" type="submit" value="Détails du produit">
    </form>
    <form action="panier.php" method="post">
        <input type="hidden" name="articleId" value="'. $article['id'] .'" ">
        <input class="btn btn-light" type="submit" value="Ajouter au panier">
    </form>
    
    
  </div>
</div>';
    }
}

// Attention il faut récupérer l'id de l'article pour voir le détail d'un article sur la page
function getArticleFromId($id)
{
    foreach (getArticles() as $article) {
        if ($article['id'] == $id) {
            return $article;
        }
    }
};
function showArticlesDetails($article){
    
    echo '<div class="container p-2">
    <div class="row justify-content-center">
    <img src="./ressources/' . $article['image'] . '" class="w-25" alt="...">
    </div>
  </div>
<br>
  <div class="container w-50 border border-dark bg-light mb-4">
    <div class="row pt-5 text-center font-weight-bold align-items-center bg-light p-3 justify-content-center">
    <h3 class="">' . $article['nom'] . '</h3>
    </div>

    <div class=\"row text-center font-italic align-items-center bg-light p-3 justify-content-center\">
        <p class="">' . $article['description'] . '</p>
</div>
    <div class=\"row text-center align-items-center bg-light p-3 ml-5 mr-5 justify-content-center\">
    <p class="">' . $article['description_detaille'] . '</p>
    </div>
    <div class=\"row text-center font-weight-light align-items-center bg-light p-3 justify-content-center\">    
    <h3 class="">' . $article['prix'] . ' €</h3>
    </div>
</div>';
}

//AFFICHAGE DU PANIER 
function afficherPanier($pageName){
    foreach ($_SESSION['panier'] as $article){
        echo '<div class="container">
<div class="row mt-4 mb-4 text-white ">
<div class="col-2 mx-auto text-center">Image
<img src="ressources/' . $article['image'] . '" alt="...">
</div>
<div class="col-2 mx-auto text-center ">Nom du Produit
<h5 class="">' . $article['nom'] . '</h5>
</div>
<div class="col-2 mx-auto text-center ">Description du produit
<h5 class="">' . $article['description'] . '</h5>
</div>

<div class="col-2 mx-auto text-center ">Prix
<h5 class="">' . $article['prix'] . ' €</h5>
</div>

<div class="col-1">
<form action="' . $pageName . '" method="post">
<input type="number" id="typeNumber" class="form-control mx-auto mt-2" name="quantite" value=' . $article['quantite'] . '> 
    <input type="hidden" name="id_article" value=' . $article['id'] . '>
    <button type="submit" for="typeNumber" class="text-center mx-auto mt-2">Modifier quantité</button>
 </form>
 </div>
 

<div class="col-2">
<form action="' . $pageName . '" method="post">
<input type="hidden" name="supprimerArticle" value=' . $article['id'] . '>
<button type="submit"class="text-center mx-auto mt-2">supprimer</button>
</form>
</div>
</div>
</div>
';
    }
}

       
// AJOUT D'UN ARTICLE DANS LE PANIER
function ajoutArticle($article){
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        if ($_SESSION['panier'][$i]['id'] == $article['id']) {
            echo "<script> alert('Article déjà présent dans le panier ! Veuillez vérifiez votre panier svp');</script>";
            return;
        }
    }
    $article['quantite']=1;
array_push($_SESSION['panier'], $article);
}
//SUPPRIMER UN ARTCILE DANS LE PANIER
function supprimerArticle($id){
    for ($i = 0; $i < count($_SESSION['panier']); $i++){
         if($_SESSION['panier'][$i]["id"] == $id){
           array_splice($_SESSION["panier"], $i,1);
           echo "<script> alert('Votre article vient d'être supprimer!');</script>";
           return;
         }
    }
}

// MODIFIER LE PANIER
function modifQuantite($quantite, $id_produit)
{ //boucler sur le panier, 

    for ($i = 0; $i < count($_SESSION["panier"]); $i++) {

        if ($id_produit == $_SESSION["panier"][$i]["id"]) {

            $_SESSION["panier"][$i]["quantite"] = $quantite;
        }
    }
}

//AVOIR LE MONTANT TOTAL DU PANIER et ensuite l'AFFICHER
function montantPanier()
{
    $prix = 0;
    for ($i = 0; $i < count($_SESSION["panier"]); $i++) {
        $prix += $_SESSION["panier"][$i]["quantite"] * $_SESSION["panier"][$i]["prix"];
    }
    return $prix;
}

function afficherTotal()
{
    echo 'Total = ' . number_format(montantPanier(), 2, " , ", " ") . '€';
}

//VIDER LE PANIER 
function viderPanier()
{
    $_SESSION["panier"] = [];
    echo '<script> alert("panier totalement vide !")</script>';
}
    
// FRAIS DE PORT
function fraisDePort()
{
    $quantite = 0;
    for ($i = 0; $i < count($_SESSION["panier"]); $i++) {
        $quantite += $_SESSION["panier"][$i]["quantite"];
    }
    return $quantite * 5;
}
function afficherFraisDePort(){
    echo 'Frais de Port = ' . number_format(fraisDePort(), 2, " , ", " ") . '€';
}
function TotalApresFdP(){
    return montantPanier() + fraisDePort();
    
}
function afficherTotalApresFdp(){
    echo 'Votre total de commande est  ' . number_format(TotalApresFdP(), 2, " , ", " ") . '€';
}