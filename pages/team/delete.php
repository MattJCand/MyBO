<?php include "../../templates/header_page.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>
<?php
  $id = $_GET['id'];
  $req = $pdo->exec("DELETE FROM `professeur` WHERE `id` = $id");
  if ($req){
     header('Location:team.php');
  }
?>
<?php include "../../templates/footer.php"; ?>
