
<?php
  $id = $_GET['id'];
  $req = $pdo->exec("DELETE FROM `actualite` WHERE `id` = $id");
  if ($req){
     header('Location:actu.php');
  }
?>
