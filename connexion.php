<?php
    include('header.php');
    include ('functions.php');
   session_start(); 
 
    if(isset($errorMsg)){
      echo '<p>'.$errorMsg.'</p>';
      if (isset($_POST['validate'])) {
        connexion();
    }
    }
      
    ?>
    <div class="container text-center" id="connexion">
    <i class="fa-solid fa-key fa-3x mb-2"></i>
    <h2>CONNEXION</h2>
    </div>

    <div class="container" id="connexion">
    <form class="formconnexion" method="post" action="index.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email :</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="paul.dupont@exemple.fr">
    <div id="emailHelp" class="form-text">Nous ne partagerons JAMAIS votre e-mails avec des tiers</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" name="password" placeholder="Entrez le mot de passe">
  </div>
  <input type="hidden" name="connexion" value="true">
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
</div>

<div class="col-md-12 text-center">
    <div class="row">
        <h3>Pas encore inscrit ?</h3>
        <form action="inscription.php">
        <button type="submit" class="btn btn-primary text-center mx-auto mt-2">Je créer mon compte</button>
        </form>
    </div>

</div>
    
    <?php
    include('footer.php');
    ?> 