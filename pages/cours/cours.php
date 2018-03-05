<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>
<?php include "../../templates/navbar.php"; ?>


<div class="block_title">
  <h1 class="align"> Index page Cours</h1>
  <a href="pages/home/home.php"><i class="fas fa-home"></i></a>
</div>

<table>
  <thead>
   <tr>
    <th>Photo Profil</th>
    <th>Intitule</th>
    <th>Description</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Tarif</th>
    <th>Editer</th>
   </tr>
  </thead>

<?php $reponse = $pdo->query("SELECT cours.intitule, cours.description, cours.tarif, professeur.prenom, professeur.nom, image.url, cours.id FROM cours INNER JOIN professeur ON cours.professeur_id = professeur.id INNER JOIN image ON professeur.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo "<tbody>";
    echo "<tr>";
    $image = $reponse_tableau["url"];
    $imageData = base64_encode(file_get_contents($image));
      echo '<td><img class="img_vignette" src="data:image/jpeg;base64,'.$imageData.'"></td>';
      echo "<td>".$reponse_tableau["intitule"]."</td>";
      echo "<td>".$reponse_tableau["description"]."</td>";
      echo "<td>".$reponse_tableau["nom"]."</td>";
      echo "<td>".$reponse_tableau["prenom"]."</td>";
      echo "<td>".$reponse_tableau["tarif"]."€</td>";
      echo "<td><a href=\"pages/cours/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a></td>";
    echo "</tr>";
    ?>
    <?php
      echo "</tbody>";
      echo "</table";
  }
?>

<?php include "../../templates/footer.php"; ?>
