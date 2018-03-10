<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>
<?php include "../../templates/navbar.php"; ?>

<h1 class="align block_title">Index Page Actualité</h1>
<a href="pages/home/home.php"><i class="fas fa-home"></i></a>
<a href="pages/actu/add.php"><i class="fas fa-plus-circle"></i></a>

<table>
  <thead>
   <tr>
    <th>titre</th>
    <th>description</th>
    <th>url</th>
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>

<?php $reponse = $pdo->query("SELECT actualite.titre, actualite.description, actualite.url, actualite.id FROM actualite ");
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    echo "<td>".$reponse_tableau["titre"]."</td>";
    echo "<td>".$reponse_tableau["description"]."</td>";
    echo "<td>".$reponse_tableau["url"]."</td>";
    echo "<td>"."<a href=\"pages/actu/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a>"."</td>";;
    echo "<td>"."<a href=\"pages/actu/delete.php?id=$reponse_tableau[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a>"."</td>";;
   echo "</tr>";
    ?>

    <?php
      echo "</tbody>";
      echo "<table";
  }
?>

<?php include "../../templates/footer.php"; ?>
