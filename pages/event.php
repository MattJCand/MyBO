
<?php
require_once '../inc/header.php';
require_once '../inc/securite.php';
require_once "../inc/menu.php";
?>

<div class="block_title">
  <h1 class="align">Index Page évenements</h1>
  <a href="home/home.php"><i class="fas fa-home"></i></a>
  <a href="event/add.php"><i class="fas fa-plus-circle"></i></a>
</div>

<table>
  <thead>
   <tr>
    <th>Nom</th>
    <th>Description</th>
    <th>Lieu</th>
    <th>Url</th>
    <th>Date Début</th>
    <th>Date fin</th>
    <th>Heure début</th>
    <th>Heure fin</th>
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>
<?php $reponse = $bdd->query("SELECT evenement.id_event, evenement.nom_event, evenement.description_event, evenement.lieu_event, evenement.url_event, image.url_img, date.date_debut, date.date_fin, horaire.heure_debut, horaire.heure_fin  FROM evenement INNER JOIN image ON evenement.id_image=image.id_img INNER JOIN Date ON evenement.id_date=date.id_date INNER JOIN horaire ON evenement.id_horaire=horaire.id_horaire " );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)){
    echo "<tbody>";
    echo "<tr>";
      echo "<td>".$reponse_tableau["nom_event"]."</td>";
      echo "<td>".$reponse_tableau["description_event"]."</td>";
      echo "<td>".$reponse_tableau["lieu_event"]."</td>";
      echo "<td>".$reponse_tableau["url_event"]."</td>";
      echo "<td>".$reponse_tableau["date_debut"]."</td>";
      echo "<td>".$reponse_tableau["date_fin"]."</td>";
      echo "<td>".$reponse_tableau["heure_debut"]."</td>";
      echo "<td>".$reponse_tableau["heure_fin"]."</td>";
      echo "<td><a href=\"event/edit.php?id=$reponse_tableau[id_event]\"><i class='fas fa-edit'></i></a></td>";
      echo "<td><a href=\"event/delete.php?id=$reponse_tableau[id_event]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a></td>";
    echo "<tr>";
    ?>

    <?php
      echo "</tbody>";
       echo "<table";
  }
?>
