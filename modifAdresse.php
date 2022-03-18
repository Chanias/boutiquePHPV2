<?php
session_start();
include('header.php');
include ('functions.php');
if (isset($_POST['modifAdresse'])){
    modifAdresse();
}
?>

<div class="mb-3">
<form method="post" action="modifAdresse.php">
    <label for="adresse" class="form-label">Adresse: </label>
    <input required type="text" class="form-control" name="adresse" value="<?php echo $_SESSION['adresse']['adresse']?>">
  </div>
  <br>
  <div class="mb-3">
    <label for="code_postal" class="form-label">Code Postal: </label>
    <input required type="text" class="form-control" name="cp"value="<?php echo $_SESSION['adresse']['cp']?>">
  </div>
  <br>
  <div class="mb-3">
    <label for="ville" class="form-label">Ville: </label>
    <input required type="text" class="form-control" name="ville"value="<?php echo $_SESSION['adresse']['ville']?>">
  </div>
  <br>
  <input type="hidden" name="modifAdresse" value="true">
  <button type="submit" class="btn btn-primary mb-5">Modifier mes informations</button>
</div>
<?php
include ('footer.php');

?>
  