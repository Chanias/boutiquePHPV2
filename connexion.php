<?php
    include('header.php');
    include ('functions.php');
   session_start(); 
   if(isset($_POST['formconnexion'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);
    if(!empty($email) AND !empty($password)) {
       $requser = $bdd->prepare("SELECT * FROM clients WHERE email = ? AND mot_de_passe = ?");
       $requser->execute(array($email, $password));
       $userexist = $requser->rowCount();
       if($userexist == 1) {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['nom'] = $userinfo['nom'];
          $_SESSION['prenom'] = $userinfo['prenom'];
          $_SESSION['mail'] = $userinfo['mail'];
          header("Location: clients.php?id=".$_SESSION['id']);
       } else {
          $erreur = "Mauvais mail ou mot de passe !";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
 }
    ?>
    <div class="container text-center" id="connexion">
    <i class="fa-solid fa-key fa-3x mb-2"></i>
    <h2>CONNEXION</h2>
    </div>

    <div class="container" id="connexion">
    <form class="formconnexion">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email :</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="paul.dupont@exemple.fr">
    <div id="emailHelp" class="form-text">Nous ne partagerons JAMAIS votre e-mails avec des tiers</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" name="password" placeholder="Entrez le mot de passe">
  </div>
 
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
</div>

<div class="col-md-12 text-center">
    <div class="row">
        <h3>Pas encore inscrit ?</h3>
        <form action="inscription.php">
        <button type="submit" for="typeNumber" class="btn btn-primary text-center mx-auto mt-2">Je créer mon compte</button>
        </form>
    </div>

</div>
    
    <?php
    include('footer.php');
    ?>