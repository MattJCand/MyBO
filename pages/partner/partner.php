<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>
<?php include "../../templates/navbar.php"; ?>


<div class="align homeLogo" style="margin: 15% 25% 0 15%;">
  <h1 class="align">Index page Partenaire</h1>
  <a href="pages/home/home.php"><i class="fas fa-home"></i></a>
  <a href="pages/partner/add.php"><i class="fas fa-plus-circle"></i></a>
</div>


<table>
  <thead>
   <tr>
    <th>Nom</th>
    <th>Adresse</th>
    <th>Description</th>
    <th>Description</th>
    <th>Offre</th>
    <th>Image</th>
   </tr>
  </thead>

<?php $reponse = $pdo->query("SELECT partenaire.nom, partenaire.adresse, partenaire.description, partenaire.offre, image.url, partenaire.id FROM partenaire INNER JOIN image ON partenaire.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    echo "<td>".$reponse_tableau["nom"]."</td>";
    echo "<td>".$reponse_tableau["adresse"]."</td>";
    echo "<td>".$reponse_tableau["description"]."</td>";
    echo "<td>".$reponse_tableau["offre"]."</td>";
    $image = $reponse_tableau["url"];
    $imageData = base64_encode(file_get_contents($image));
    echo '<td><img src="data:image/jpeg;base64,'.$imageData.'"></td>';
    echo "<td><a href=\"pages/partner/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a></td>";
    echo "<td><a href=\"pages/partner/delete.php?id=$reponse_tableau[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a></td>";
  echo "<tr>";

?>

    <?php
      echo "</tbody>";
      echo "<table";
  }
?>

<?php include "../../templates/footer.php"; ?>
