
<?php
  $id = $_GET['id'];
  $req = $pdo->exec("DELETE FROM `Professeur` WHERE `id_prof` = $id");
  if ($req){
     header('Location:team.php');
  }
?>

