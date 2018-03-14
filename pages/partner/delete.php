<?php
require_once '../../inc/header.php';
require_once '../../inc/securite.php';
require_once "../../inc/menu.php"; ?>
<?php
  $id = $_GET['id'];
  $req = $bdd->exec("DELETE FROM `partenaire` WHERE `id_partenaire` = $id");
  if ($req){
     header('Location:../partner.php');
  }
?>
