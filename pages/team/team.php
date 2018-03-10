<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>
<?php include "../../templates/navbar.php"; ?>

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
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>

<?php $reponse = $pdo->query("SELECT professeur.nom, professeur.prenom, professeur.profession, professeur.description, professeur.email, professeur.image_profil, professeur.id FROM professeur" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    echo "<td>".$reponse_tableau["prenom"]."</td>";
    echo "<td>".$reponse_tableau["nom"]."</td>";
    echo "<td>".$reponse_tableau["profession"]."</td>";
    echo "<td>".$reponse_tableau["description"]."</td>";
    echo "<td>".$reponse_tableau["email"]."</td>";
    echo "<td>"."<a href=\"pages/team/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a>"."</td>";;
    echo "<td>"."<a href=\"pages/team/delete.php?id=$reponse_tableau[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a>"."</td>";;
   echo "</tr>";
    ?>

    <?php
      echo "</tbody>";
      echo "<table";
  }
?>

<?php include "../../templates/footer.php"; ?>
