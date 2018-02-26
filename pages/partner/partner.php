<?php include "../../templates/header_page.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Index page Partenaire</h1>
<a href="../home/home.php"><i class="fas fa-home"></i></a>
<a href="add.php"><i class="fas fa-plus-circle"></i></a>

<?php $reponse = $pdo->query("SELECT partenaire.nom, partenaire.adresse, partenaire.description, image.url FROM partenaire INNER JOIN image ON partenaire.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo $reponse_tableau["nom"]."</br>";
    echo $reponse_tableau["adresse"]."</br>";
    echo $reponse_tableau["description"]."</br>";
    echo $reponse_tableau["url"]."</br>"."<hr>";
    ?>
    <a href="edit.php"><i class="fas fa-edit"></i></a>
    <a href="delete.php"><i class="fas fa-trash"></i></a>

    <?php
       echo '</div>';
       echo '<hr>';
  }
?>

<?php include "../../templates/footer.php"; ?>
