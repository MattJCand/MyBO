<?php
  require_once "../../inc/inc.php";
?>

<?php
  $id = $_GET['id'];
  $req = $bdd->exec("DELETE FROM 'actualite' WHERE 'id_actu' = $id");
  if ($req){
     header('Location:../actu.php');
  }
?>
