
<?php
require_once '../inc/header.php';
require_once '../inc/securite.php';
require_once "../inc/menu.php"; ?>

<div class="block_title">
  <h1 class="align">Index Page évenements</h1>
  <a href="pages/home/home.php"><i class="fas fa-home"></i></a>
  <a href="pages/event/add.php"><i class="fas fa-plus-circle"></i></a>
</div>

<table>
  <thead>
   <tr>
    <th>Image</th>
    <th>Nom</th>
    <th>Description</th>
    <th>Lieu</th>
    <th>Url</th>
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>
<?php $reponse = $pdo->query("SELECT evenement.image, evenement.nom, evenement.description, evenement.url, evenement.lieu, evenement.id FROM evenement " );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)){
    echo "<tbody>";
    echo "<tr>";
      echo "<td>".$reponse_tableau["image"]."</td>";
      echo "<td>".$reponse_tableau["nom"]."</td>";
      echo "<td>".$reponse_tableau["description"]."</td>";
      echo "<td>".$reponse_tableau["lieu"]."</td>";
      echo "<td>".$reponse_tableau["url"]."</td>";
      echo "<td><a href=\"pages/event/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a></td>";
      echo "<td><a href=\"pages/event/delete.php?id=$reponse_tableau[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a></td>";
    echo "<tr>";
    ?>

    <?php
      echo "</tbody>";
       echo "<table";
  }
?>

