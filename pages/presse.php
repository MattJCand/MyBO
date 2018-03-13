<?php
require_once '../inc/header.php';
require_once '../inc/securite.php';
require_once "../inc/menu.php"; ?>

<h1 class="align block_title">Index Page Press</h1>
<a href="pages/home/home.php"><i class="fas fa-home"></i></a>
<a href="pages/press/add.php"><i class="fas fa-plus-circle"></i></a>

<table>
  <thead>
   <tr>
   <!--  <th>Image</th> -->
    <th>Titre</th>
    <th>Date Créa</th>
    <th>Description</th>
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>


<?php $reponse = $pdo->query("SELECT presse.titre, presse.image, presse.url, presse.description, presse.id FROM presse" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    #$image = $reponse_tableau["image"];
    #$imageData = base64_encode(file_get_contents($image));
    #echo '<td><img class="img_vignette" src="data:image/jpeg;base64,'.$imageData.'"></td>';
    echo "<td>".$reponse_tableau["titre"]."</td>";
    echo "<td>".$reponse_tableau["url"]."</td>";
    echo "<td>".$reponse_tableau["description"]."</td>";
    echo "<td><a href=\"pages/press/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a></td>";
    echo "<td><a href=\"pages/press/delete.php?id=$reponse_tableau[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a></td>";
   echo "</tr>";
    ?>
    <?php
      echo "</tbody>";
      echo "<table";
  }
?>

