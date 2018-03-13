<?php
  require_once "../inc/menu.php";
?>

<div class="align homeLogo block_title">
  <h1 class="align">Index page Partenaire</h1>
  <a href="home.php"><i class="fas fa-home"></i></a>
  <a href="pages/partner/add.php"><i class="fas fa-plus-circle"></i></a>
</div>


<table>
  <thead>
   <tr>
    <!-- <th>Logo</th> -->
    <th>Nom</th>
    <th>Description</th>
    <th>Editer</th>
    <th>Supprimer</th>
   </tr>
  </thead>

<?php $reponse = $bdd->query("SELECT partenaire.nom, partenaire.logo, partenaire.description, partenaire.id FROM partenaire ");
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    #$logo = $reponse_tableau["logo"];
    #$imageData = base64_encode(file_get_contents($logo));
    #echo '<td><img class="img_vignette" src="data:image/jpeg;base64,'.$imageData.'"></td>';
    echo "<td>".$reponse_tableau["nom"]."</td>";
    echo "<td>".$reponse_tableau["description"]."</td>";
    echo "<td><a href=\"pages/partner/edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a></td>";
    echo "<td><a href=\"pages/partner/delete.php?id=$reponse_tableau[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a></td>";
  echo "</tr>";

?>

    <?php
      echo "</tbody>";
      echo "<table";
  }
?>
