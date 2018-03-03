<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>
<?php include "../../templates/navbar.php"; ?>


<div style="margin: 15% 25% 0 15%;">
  <h1 class="align">Index Page évenements</h1>
  <a href="pages/home/home.php"><i class="fas fa-home"></i></a>
  <a href="pages/event/add.php"><i class="fas fa-plus-circle"></i></a>
</div>

<table>
  <thead>
   <tr>
    <th>Titre</th>
    <th>Date Créa</th>
    <th>Description</th>
    <th>Lien Event</th>
    <th></th>
    <th></th>
   </tr>
  </thead>
<?php $reponse = $pdo->query("SELECT evenement.titre, evenement.dateCrea, evenement.description, evenement.url, evenement.id FROM evenement INNER JOIN image ON evenement.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)){
    echo "<tbody>";
    echo "<tr>";
      echo "<td>".$reponse_tableau["titre"]."</td";
      echo "<td>".$reponse_tableau["dateCrea"]."</td>";
      echo "<td>".$reponse_tableau["description"]."</td>";
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

<?php include "../../templates/footer.php"; ?>
