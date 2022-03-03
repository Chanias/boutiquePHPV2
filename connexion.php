<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

try
{
    $bdd = new PDO('mysql:host=127.0.0.1:8889;dbname=site_vitrine;charset=utf8', 'Floriane', 'Diablo18!!', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>
