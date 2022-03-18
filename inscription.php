<?php
    include('header.php');
    include ('functions.php');
   session_start(); 
   
   
    ?>
    <body>
        <br><br>
    <div class="container" id="inscription"> 
<div class="row">
<form class="w-50 mx-auto" action="index.php" method="post">
  <?php
if(isset($errorMsg)){
  echo '<p>'.$errorMsg.'</p>';
  
}
  ?>
  <div class="mb-3 mt-5">
    <label for="nom" class="form-label">Nom: </label>
    <input required type="text" class="form-control" name="nom">
  </div>
  <div class="mb-3">
    <label for="prenom" class="form-label">Prénom: </label>
    <input required type="text" class="form-control" name="prenom">
  </div>
  <div class="mb-3 ">
    <label for="Email" class="form-label">Adresse email: </label>
    <input required type="email" class="form-control" name="email" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="Password" class="form-label">Mot de passe: </label>
    <small id="emailHelp" class="form-text"></small>
    <input required type="password" class="form-control" name="password">
  </div>
  <div class="mb-3">
    <label for="adresse" class="form-label">Adresse: </label>
    <input required type="text" class="form-control" name="adresse">
  </div>
  <div class="mb-3">
    <label for="code_postal" class="form-label">Code Postal: </label>
    <input required type="text" class="form-control" name="cp">
  </div>
  <div class="mb-3">
    <label for="ville" class="form-label">Ville: </label>
    <input required type="text" class="form-control" name="ville">
  </div>
  <input type="hidden" name="inscription" value="true">
  <button type="submit" class="btn btn-primary mb-5">Inscription</button>
</form>
</div>
</div>    
    </body>