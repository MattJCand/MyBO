
<?php
  $id = $_GET['id'];
  $req = $pdo->exec("DELETE FROM `presse` WHERE `id` = $id");
  if ($req){
     header('Location:press.php');
  }
?>
