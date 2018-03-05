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
    <th>Image</th>
    <th>Prenom</th>
    <th>Nom</th>
    <th>Profession</th>
    <th>Description</th>
    <th>Mobile</th>
    <th>Email</th>
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>

<?php $reponse = $pdo->query("SELECT professeur.nom, professeur.prenom, professeur.profession,professeur.description, professeur.mobile, professeur.email, image.url, professeur.id FROM professeur INNER JOIN image ON professeur.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
   $image = $reponse_tableau["url"];
   $imageData = base64_encode(file_get_contents($image));
    echo '<td><img class="img_vignette" src="data:image/jpeg;base64,'.$imageData.'"></td>';
    echo "<td>".$reponse_tableau["prenom"]."</td>";
    echo "<td>".$reponse_tableau["nom"]."</td>";
    echo "<td>".$reponse_tableau["profession"]."</td>";
    echo "<td>".$reponse_tableau["description"]."</td>";
    echo "<td>".$reponse_tableau["mobile"]."</td>";
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
