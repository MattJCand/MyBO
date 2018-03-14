<?php
require_once '../../inc/header.php';
require_once '../../inc/securite.php';
require_once "../../inc/menu.php"; ?>
<?php
  $id = $_GET['id'];
  $req = $bdd->exec("DELETE FROM `evenement` WHERE `id_event` = $id");
  if ($req){
     header('Location:../event.php');
  }
?>
