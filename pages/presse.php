<?php
  require_once "../inc/menu.php";
 ?>

<h1 class="align block_title">Index Page Press</h1>
<a href="home.php"><i class="fas fa-home"></i></a>
<a href="pages/press/add.php"><i class="fas fa-plus-circle"></i></a>

<table>
  <thead>
   <tr>
   <!--  <th>Image</th> -->
    <th>Titre</th>
    <th>Date Créa</th>
    <th>Description</th>
    <th>Image</th>
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>


<?php $reponse = $bdd->query("SELECT presse.titre_presse, presse.url_presse, presse.description_presse, presse.id_presse, image.url_img FROM presse INNER JOIN image ON presse.id_image=image.id_img" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    #$image = $reponse_tableau["image"];
    #$imageData = base64_encode(file_get_contents($image));
    #echo '<td><img class="img_vignette" src="data:image/jpeg;base64,'.$imageData.'"></td>';
    echo "<td>".$reponse_tableau["titre_presse"]."</td>";
    echo "<td>".$reponse_tableau["url_presse"]."</td>";
    echo "<td>".$reponse_tableau["description_presse"]."</td>";
    echo "<td>".$reponse_tableau["url_img"]."</td>";
    echo "<td><a href=\"press/edit.php?id=$reponse_tableau[id_presse]\"><i class='fas fa-edit'></i></a></td>";
    echo "<td><a href=\"press/delete.php?id=$reponse_tableau[id_presse]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a></td>";
   echo "</tr>";
    ?>
    <?php
      echo "</tbody>";
      echo "<table";
  }
?>
