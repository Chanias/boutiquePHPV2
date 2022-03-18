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
        //les données de l'utilisateur pour l'inscription
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
                    //insérer l'utlisisateur dans la base de données
                    $insertUserOnWebsite = $db->prepare("INSERT INTO `clients`(`nom`, `prenom`, `email`, `password`) VALUES (?,?,?,?)");
                    $insertUserOnWebsite->execute(array($user_nom, $user_prenom, $user_email, $user_password));

                    $id = $db->lastInsertId();
                    //sauvegarder les données dans la table adresse
                    $saveUserOnWebsite = $db->prepare("INSERT INTO `adresses` (`id_client`, `adresse`, `cp`, `ville`) VALUES(?,?,?,?)");
                    $saveUserOnWebsite->execute(array($id, $user_adresse, $user_cp, $user_ville));
                    echo "<script>alert('Inscription réussie...')</script>";
                } else {
                    echo "<script>alert('Sécurité du mot de passe insuffisant')</script>";
                }
            } else {
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
function checkPassword($user_password)
{
    $regex = "^(?=.*[0-9])(?=.*[a-zA-Z]).{8,15}$^";

    if (preg_match($regex, $user_password)) {
        return true;
    } else {
        return false;
    }
}
// INSCRIPTION

function connexion()
{
    $db = getConnexion();
    //Validation du formulaire

    //Vérifier si l'utlisisateur a bien compléter tous les champs
    if (!empty($_POST['email']) and !empty($_POST['password'])) {

        //les données de l'utilisateur pour la connexion
        $user_email = htmlspecialchars($_POST['email']);
        $user_password = htmlspecialchars($_POST['password']);

        if (checkIfUserAlreadyExist($user_email)) {

            $checkIfUserAlreadyExist = $db->prepare("SELECT * FROM clients WHERE email=?");
            $checkIfUserAlreadyExist->execute(array($user_email));
            $userInfos = $checkIfUserAlreadyExist->fetch();

            if (password_verify($user_password, $userInfos['password'])) {
                $_SESSION['id'] = $userInfos['id'];
                $_SESSION['nom'] = $userInfos['nom'];
                $_SESSION['prenom'] = $userInfos['prenom'];
                $_SESSION['email'] = $userInfos['email'];
                $_SESSION['password'] = $userInfos['password'];

                $adresse = recupAdresse();

                // stockage dans la session
                $_SESSION['adresse'] = $adresse;



                echo "<script>alert('Vous êtes connecté(e)')</script>";
            } else {
                echo "<script>alert('Votre mot de passe est incorrect...')</script>";
            }
        } else {
            echo "<script>alert('Votre email est incorrect...')</script>";
        }
    } else {
        echo "<script>alert('Veuillez compléter tous les champs...')</script>";
    }
}
// DECONNEXION
function deconnexion()
{
    $db = getConnexion();
    $_SESSION = array();
    session_destroy();
}

// MON COMPTE
//récupération du nom
function modifInfos()
{
    $db = getConnexion();
    if (empty($_POST['nom']) || empty($_POST['prenom'])) {
        echo "<script>alert('Veuillez compléter tous les champs...')</script>";
    } else {
        if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 25) {
            echo "Nombre de lettres pour le nom trop court";
            return;
        }

        if (strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 25) {
            echo "Nombre de lettres pour le prenom trop court";
            return;
        }

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);


        $req = $db->prepare("UPDATE `clients` SET `nom`=?,`prenom`=? WHERE id=?");
        $req->execute(array($nom, $prenom, $_SESSION['id']));

        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;


        echo "<script>alert('Modification des infos réussie...')</script>";
    }
}

function modifAdresse()
{
    $db = getConnexion();
    if (empty($_POST['adresse']) || empty($_POST['cp']) || empty($_POST['ville'])) {
        echo "<script>alert('Veuillez compléter tous les champs...')</script>";
    } else {
        if (strlen($_POST['adresse']) < 8 || strlen($_POST['adresse']) > 50) {
            echo "Nombre de lettres pour l'adresse' trop court";
            return;
        }
        if (strlen($_POST['cp']) !== 5) {
            echo "Nombre de lettres pour le code postal trop court";
            return;
        }
        if (strlen($_POST['ville']) < 3 || strlen($_POST['ville']) > 25) {
            echo "Nombre de lettres pour la ville trop court";
            return;
        }

        $adresse = htmlspecialchars($_POST['adresse']);

        $req = $db->prepare('UPDATE `adresses` SET  `adresse`=?,`cp`=?, `ville`=? WHERE id_client = ?');
        $req->execute(array($adresse, $_SESSION['id']));


        $_SESSION["adresse"]["adresse"] = $_POST["adresse"];
        $_SESSION["adresse"]["cp"] = $_POST["cp"];
        $_SESSION["adresse"]["ville"] = $_POST["ville"];


        echo "<script>alert('Modification des infos réussie...')</script>";
    }
}

// récupération adresse
function recupAdresse()
{
    $db = getConnexion();
    $adresse = $db->prepare("SELECT * FROM adresses WHERE id_client= ?");
    $adresse->execute(array($_SESSION['id']));
    return $adresse->fetch();
}

// récupération Mot de passe
function recupMdp()
{
    $db = getConnexion();
    $query = $db->prepare('SELECT `password` FROM clients WHERE id = ?');
    $query->execute(array($_SESSION['id']));
    return $query->fetch();
}

// MODIFICATION MOT DE PASSE
function modifMdp()
{
    $db = getConnexion();
    //Vérifier si l'utlisisateur a bien compléter tous les champs
    if (empty($_POST['password']) || empty($_POST['newPassword'])) {
        echo "<script>alert('Veuillez compléter tous les champs...')</script>";
        return false;
    } else {
        //on vérifie le mot de passe actuel
        $currentPassword = recupMdp();
        $currentPassword = $currentPassword['password'];

        // si mdp saisie = mdp actuel
        if (!password_verify($_POST['password'], $currentPassword)) {
            echo 'Le mot de passe actuel que vous avez saisie est incorrect, veuillez réessayer';
            return false;
        } else {
            //on nettoie le nouveau mot de passe
            $newPassword = htmlspecialchars($_POST['newPassword']);
            //on vérifie que le nouveau mot de passe est ok pour la regex
            if (!checkPassword($newPassword)) {
                echo "<script>alert('Votre mot de passe n'a pas les conditions requises : 1 majuscule, au moins 1 chiffre, au moins 1 caractère spécial, et limité à 15 caractères...')</script>";
            } else {
                $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                // si mot de passe ok, on insert dans la bdd
                $req = $db->prepare('UPDATE `clients` SET  `password`=? WHERE id= ?');
                $req->execute(array($newPassword, $_SESSION['id']));
                
                echo "<script>alert('Modification des infos réussie...')</script>";
            }
        }
    }
}
