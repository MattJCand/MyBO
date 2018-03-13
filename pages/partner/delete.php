
<?php
  $id = $_GET['id'];
  $req = $pdo->exec("DELETE FROM `partenaire` WHERE `id` = $id");
  if ($req){
     header('Location:partner.php');
  }
?>
