<?php
session_start();
include('header.php');
include ('functions.php');
if (isset($_POST['modifMdp'])){
  modifMdp();
}
?>

<div class="mb-3">
<form method="post" action="modifMdp.php">
    <label for="Password" class="form-label">Ancien mot de passe </label>
    <small id="emailHelp" class="form-text"></small>
    <input required type="password" class="form-control" name="password">
</div>
<br><br>
<div class="mb-3">
    <label for="Password" class="form-label">Nouveau mot de passe </label>
    <small id="emailHelp" class="form-text"></small>
    <input required type="password" class="form-control" name="newPassword" >
</div>

  <input type="hidden" name="modifMdp" value="true">
  <button type="submit" class="btn btn-primary mb-5">Modifier mes informations</button>
</div>
<?php
include ('footer.php');

?>
  