
<?php
  $id = $_GET['id'];
  $req = $pdo->exec("DELETE FROM `evenement` WHERE `id` = $id");
  if ($req){
     header('Location:event.php');
  }
?>
