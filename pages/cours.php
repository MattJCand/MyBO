<?php
require_once '../inc/header.php';
require_once '../inc/securite.php';
require_once "../inc/menu.php"; ?>

<div class="block_title">
  <h1 class="align"> Index page Cours</h1>
  <a href="pages/home/home.php"><i class="fas fa-home"></i></a>
</div>

<table>
  <thead>
   <tr>
    <th>Intitule</th>
    <th>Description</th>
    <th>Objectif Un</th>
    <th>Objectif Deux</th>
    <th>Objectif Trois</th>
    <th>Editer</th>
   </tr>
 </thead>

<?php $reponse = $pdo->query("SELECT * FROM Cours" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo "<tbody>";
    echo "<tr>";
      echo "<td>".$reponse_tableau["intitule_cours"]."</td>";
      echo "<td>".$reponse_tableau["description_cours"]."</td>";
      echo "<td><a href=\"pages/cours/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a></td>";
    echo "</tr>";
    ?>
    <?php
      echo "</tbody>";
      echo "</table";
  }
?>

