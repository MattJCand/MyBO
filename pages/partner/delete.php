<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>
<?php
  $id = $_GET['id'];
  $req = $pdo->exec("DELETE FROM `partenaire` WHERE `id` = $id");
  if ($req){
     header('Location:partner.php');
  }
?>
<?php include "../../templates/footer.php"; ?>
