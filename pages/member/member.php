<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>
<?php include "../../templates/navbar.php"; ?>

<h1 class="align block_title">Index Page Membre</h1>
<a href="pages/home/home.php"><i class="fas fa-home"></i></a>

<table>
  <thead>
   <tr>
    <th>Description</th>
    <th>Prix Enfant</th>
    <th>Prix Adulte</th>
    <th>Editer</th>
   </tr>
  </thead>

<?php $reponse = $pdo->query("SELECT membre.description, membre.prix_enfant, membre.prix_adulte, membre.id FROM membre" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    echo "<td>".$reponse_tableau["description"]."</td>";
    echo "<td>".$reponse_tableau["prix_enfant"]."</td>";
    echo "<td>".$reponse_tableau["prix_adulte"]."</td>";
    echo "<td>"."<a href=\"pages/member/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a>"."</td>";;
   echo "</tr>";
    ?>

    <?php
      echo "</tbody>";
      echo "<table";
  }
?>

<?php include "../../templates/footer.php"; ?>
