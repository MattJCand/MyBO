<?php
require_once '../inc/header.php';
require_once '../inc/securite.php';
require_once "../inc/menu.php"; ?>

<h1 class="align block_title">Index Page Equipe</h1>
<a href="pages/home/home.php"><i class="fas fa-home"></i></a>
<a href="pages/team/add.php"><i class="fas fa-plus-circle"></i></a>

<table>
  <thead>
   <tr>
    <th>Prenom</th>
    <th>Nom</th>
    <th>Profession</th>
    <th>Description</th>
    <th>Email</th>
    <th>Tarif Cours</th>
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>

<?php $reponse = $pdo->query("SELECT professeur.nom_prof, professeur.prenom_prof, professeur.profession_prof, professeur.description_prof, professeur.email_prof, professeur.tarif_prof, professeur.id_prof FROM Professeur" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    echo "<td>".$reponse_tableau["prenom_prof"]."</td>";
    echo "<td>".$reponse_tableau["nom_prof"]."</td>";
    echo "<td>".$reponse_tableau["profession_prof"]."</td>";
    echo "<td>".$reponse_tableau["description_prof"]."</td>";
    echo "<td>".$reponse_tableau["email_prof"]."</td>";
    echo "<td>".$reponse_tableau["tarif_prof"]."</td>";
    echo "<td>"."<a href=\"pages/team/edit.php?id=$reponse_tableau[id_prof]\"><i class='fas fa-edit'></i></a>"."</td>";;
    echo "<td>"."<a href=\"pages/team/delete.php?id=$reponse_tableau[id_prof]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a>"."</td>";;
   echo "</tr>";
    ?>

    <?php
      echo "</tbody>";
      echo "<table";
  }
?>
