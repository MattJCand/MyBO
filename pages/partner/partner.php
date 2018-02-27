<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Index page Partenaire</h1>
<a href="../home/home.php"><i class="fas fa-home"></i></a>
<a href="add.php"><i class="fas fa-plus-circle"></i></a>

<?php $reponse = $pdo->query("SELECT partenaire.nom, partenaire.adresse, partenaire.description, partenaire.offre, image.url, partenaire.id FROM partenaire INNER JOIN image ON partenaire.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo $reponse_tableau["nom"]."</br>";
    echo $reponse_tableau["adresse"]."</br>";
    echo $reponse_tableau["description"]."</br>";
    echo $reponse_tableau["offre"]."</br>";
    echo $reponse_tableau["url"]."</br>"."<hr>";
    echo "<a href=\"edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a>";
    echo "<a href=\"delete.php?id=$reponse_tableau[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a>";
    ?>

    <?php
       echo '</div>';
       echo '<hr>';
  }
?>

<?php include "../../templates/footer.php"; ?>
