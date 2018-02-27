<?php include "../../templates/header_page.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Index Page Equipe</h1>
<a href="../home/home.php"><i class="fas fa-home"></i></a>
<a href="add.php"><i class="fas fa-plus-circle"></i></a>



<?php $reponse = $pdo->query("SELECT professeur.nom, professeur.prenom, professeur.profession,professeur.description, professeur.mobile, professeur.email, image.url, professeur.id FROM professeur INNER JOIN image ON professeur.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo '<div>';
    echo $reponse_tableau["prenom"]."</br>";
    echo $reponse_tableau["nom"]."</br>";
    echo $reponse_tableau["profession"]."</br>";
    echo $reponse_tableau["description"]."</br>";
    echo $reponse_tableau["mobile"]."</br>";
    echo $reponse_tableau["email"]."</br>";
    echo $reponse_tableau["url"]."</br>";
    echo "<a href=\"edit.php?id=$reponse_tableau[id]\"><i class='fas fa-edit'></i></a>";
    echo "<a href=\"delete.php?id=$reponse_tableau[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><i class='fas fa-trash'></i></a>";
    ?>

    <?php
       echo '</div>';
       echo '<hr>';
  }
?>

<?php include "../../templates/footer.php"; ?>
