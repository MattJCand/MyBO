<?php
  require_once '../../inc/header.php';
  $id = $_GET['id'];
  $req = $bdd->exec("DELETE FROM `evenement` WHERE `id_event` = $id");
  if ($req){
     header('Location:../event.php');
  }
?>
