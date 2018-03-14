<?php
require_once '../../inc/header.php';
require_once '../../inc/securite.php';
require_once "../../inc/menu.php"; ?>
<?php
  $id = $_GET['id'];
  $req = $bdd->exec("DELETE FROM `Professeur` WHERE `id_prof` = $id");
  if ($req){
     header('Location:../team.php');
  }
?>
