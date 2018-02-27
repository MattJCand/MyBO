<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align"> Index page Cours</h1>
<a href="../home/home.php"><i class="fas fa-home"></i></a>


<?php $reponse = $pdo->query("SELECT cours.intitule, cours.description, professeur.prenom, professeur.nom, image.url FROM cours INNER JOIN professeur ON cours.professeur_id = professeur.id INNER JOIN image ON professeur.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo $reponse_tableau["intitule"]."</br>";
    echo $reponse_tableau["description"]."</br>";
    echo $reponse_tableau["nom"]."</br>";
    echo $reponse_tableau["prenom"]."</br>";
    echo $reponse_tableau["nom"]."</br>";
    echo $reponse_tableau["url"]."</br>";
    ?>
    <a href="edit.php"><i class="fas fa-edit"></i></a>
    <a href="delete.php"><i class="fas fa-trash"></i></a>

    <?php
       echo '</div>';
       echo '<hr>';
  }
?>

<?php include "../../templates/footer.php"; ?>
