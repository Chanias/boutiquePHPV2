<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function getConnexion()
{
    try {
        $db = new PDO('mysql:host=127.0.0.1;dbname=site_vitrine;charset=utf8', 'Floriane', 'Diablo18!!', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $db;
}

// Déclaration du tableau d'articles et le retourne
function getArticles()
{
    $db = getConnexion();
    $query = $db->query("SELECT `id`,`image`,`nom`,`description`, `prix` FROM `articles`");
    return $query->fetchAll();
}
// affichage des articles + bouton du détails produit

function show_articles($articles)
{


    foreach ($articles as $article) {
        // il faut créer comme un formulaire pour le "bouton détails"
        echo '
        
        <div class="card mx-auto col-md-4 mb-5" style="width: 22rem;">
  <img src="./ressources/' . $article['image'] . '" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">' . $article['nom'] . '</h5>
    <p class="card-text">' . $article['description'] . '</p>
    <p class="card-text">' . number_format($article['prix'], 2, ',', ' ') . ' €</p>
    <div class="d-grid gap-2 ">
    <form action="produit.php" method="post">
        <input type="hidden" name="articleId" value="' . $article['id'] . '" ">
        <input class="btn btn-primary" type="submit" value="Détails du produit">
    </form>
    <form action="panier.php" method="post">
        <input type="hidden" name="articleId" value="' . $article['id'] . '" ">
        <input class="btn btn-primary" type="submit" value="Ajouter au panier">
    </form>
    </div>
  </div>
</div>';
    }
}

// Attention il faut récupérer l'id de l'article pour voir le détail d'un article sur la page
function getArticleFromId($id)
{
    //foreach (getArticles() as $article) {
    // if ($article['id'] == $id) {
    //    return $article;
    // }
    //  }
    $db = getConnexion();
    $query = $db->prepare('SELECT * FROM Articles WHERE id = ?');
    $query->execute(array($id));
    return $query->fetch();
}

function showArticlesDetails($article)
{

    echo '<div class="container fluid">
    <div class="col-md-12">
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
    <div class=\"row text-center font-weight-light align-items-center bg-light justify-content-center\">    
    <h3 class="">' . $article['prix'] . ' €</h3>
    </div>
</div>
    </div>
    ';
}

//AFFICHAGE DU PANIER 
function afficherPanier($pageName)
{
    foreach ($_SESSION['panier'] as $article) {
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
//RECUPERER LES GAMMES ET LES AFFICHER
function recupGammes()
{
    $db = getConnexion();
    $query = $db->query('SELECT * FROM gammes');
    return $query->fetchall();
}
function affichGammes()
{
    $gammes = recupGammes();
    foreach ($gammes as $gamme) { //boucler sur la fonction qui appelle la gamme pour ensuite rechercher un article par gamme
        echo '<h3>' . $gamme['nom'] . '</h3>';
        $articlegamme = recupArticlesGamme($gamme['id']);
        show_articles($articlegamme);
    }
}
//RECUPERER LES ARTICLES PAR ID DANS LES GAMMES ET LES AFFICHER
function recupArticlesGamme($id_gamme)
{
    $db = getConnexion();
    $result = $db->prepare("SELECT * FROM `articles` WHERE `id_gamme`=?");
    $result->execute([$id_gamme]);
    return $result->fetchAll();
}

// AJOUT D'UN ARTICLE DANS LE PANIER
function ajoutArticle($article)
{
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        if ($_SESSION['panier'][$i]['id'] == $article['id']) {
            echo "<script> alert('Article déjà présent dans le panier ! Veuillez vérifiez votre panier svp');</script>";
            return;
        }
    }
    $article['quantite'] = 1;
    array_push($_SESSION['panier'], $article);
}

//SUPPRIMER UN ARTCILE DANS LE PANIER
function supprimerArticle($id)
{
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {
        if ($_SESSION['panier'][$i]["id"] == $id) {
            array_splice($_SESSION["panier"], $i, 1);
            echo "<script> alert('Votre article vient d'être supprimer!');</script>";
            return;
        }
    }
}

// MODIFIER LES QUANTITES DANS LE PANIER
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

function afficherFraisDePort()
{
    echo 'Frais de Port = ' . number_format(fraisDePort(), 2, " , ", " ") . '€';
}

function TotalApresFdP()
{
    return montantPanier() + fraisDePort();
}

function afficherTotalApresFdp()
{
    echo 'Votre total de commande est  ' . number_format(TotalApresFdP(), 2, " , ", " ") . '€';
}



// INSCRIPTION

function inscription()
{
    $db = getConnexion();

    if (
        !empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['email']) and !empty($_POST['password'])
        and !empty($_POST['adresse']) and !empty($_POST['cp']) and !empty($_POST['ville'])
    ) {
        $user_nom = htmlspecialchars($_POST['nom']);
        $user_prenom = htmlspecialchars($_POST['prenom']);
        $user_email = htmlspecialchars($_POST['email']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_adresse = htmlspecialchars($_POST['adresse']);
        $user_cp = htmlspecialchars($_POST['cp']);
        $user_ville = htmlspecialchars($_POST['ville']);

        // //la vérification des champs
        if (checkInputLength()) {
            //     // vérification mot de passe valide 
            if (checkIfUserAlreadyExist($user_email) == false) {

              if (checkPassword($user_password)) {

                    $insertUserOnWebsite = $db->prepare("INSERT INTO `clients`(`nom`, `prenom`, `email`, `password`) VALUES (?,?,?,?)");
                    $insertUserOnWebsite->execute(array($user_nom, $user_prenom, $user_email, $user_password));
                    echo "<script>alert('Inscription réussie...')</script>";

                    $saveUserOnWebsite = $db->prepare("INSERT INTO `adresses`(`adresse`, `cp`, `ville`) VALUES (?,?,?)");
                    $saveUserOnWebsite->execute(array($user_adresse, $user_cp, $user_ville));
                } 

                else {
                    echo "<script>alert('Sécurité du mot de passe insuffisant')";
                    var_dump('test');
                }
            } 
            else {
                echo "<script>alert('L\'utilisateur existe déjà sur le site...')</script>";
            }
        } else {
            echo "<script>alert('Longeur incorrecte de plusieurs champs...')</script>";
        }
    } else {
        echo "<script>alert('Veuillez remplir le formulaire...')</Veuillez>";
    }
}


function checkInputLength()
{
    $longeurChampsCorrect = true;

    if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 25) {
        echo "Nombre de lettres pour le nom trop court";
        return false;
    }
    if (strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 25) {
        echo "Nombre de lettres pour le prenom trop court";
        return false;
    }
    if (strlen($_POST['email']) < 8 || strlen($_POST['email']) > 40) {
        echo "Nombre de lettres pour l'email' trop court";
        return false;
    }
    if (strlen($_POST['adresse']) < 8 || strlen($_POST['adresse']) > 50) {
        echo "Nombre de lettres pour l'adresse' trop court";
        return false;
    }
    if (strlen($_POST['cp']) !== 5) {
        echo "Nombre de lettres pour le code postal trop court";
        return false;
    }
    if (strlen($_POST['ville']) < 3 || strlen($_POST['ville']) > 25) {
        echo "Nombre de lettres pour la ville trop court";
        return false;
    }
    return true;
}
function checkIfUserAlreadyExist($user_email)
{
    $db = getConnexion();
    $checkIfUserAlreadyExist = $db->prepare("SELECT * FROM clients WHERE email=?");
    $checkIfUserAlreadyExist->execute(array($user_email));
    if ($checkIfUserAlreadyExist->rowCount() == 0) {
        return false; // il n'existe pas, nous allons pouvoir le créer
    } else {
        return true; //on ne peut pas l'inscrire car il existe déjà
    }
}
function checkPassword($user_password){
    $regex = "^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@$!%*?/&])(?=\S+$).{8,15}$^";
    if (preg_match($regex, $user_password)){
        return true;
    }else{
        return false;
    }
}