<?php

session_start();
include ('header.php');
include ('functions.php');
if (isset($_POST['modifInfos'])){
    modifInfos();
}
?>

<div class="mb-3 mt-5">
   
     <form method="post" action="modifInfos.php">
    <label for="nom" class="form-label">Nom: </label>
    <input required type="text" class="form-control" name="nom" value="<?php echo $_SESSION['nom']?>">
  </div>
  <br><br>
  <div class="mb-3">
    <label for="prenom" class="form-label">Prénom: </label>
    <input required type="text" class="form-control" name="prenom"value="<?php echo $_SESSION['prenom']?>">
  </div>
 
  <input type="hidden" name="modifInfos" value="true">
  <button type="submit" class="btn btn-primary mb-5">Modifier mes informations</button>
</div>
<?php
include ('footer.php');

?>
  