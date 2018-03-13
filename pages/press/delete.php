<?php
  require_once "../../inc/inc.php";
?>

<?php
  $id = $_GET['id'];
  $req = $bdd->exec("DELETE FROM `presse` WHERE `id_presse` = $id");
  if ($req){
     header('Location:../presse.php');
  }
?>
