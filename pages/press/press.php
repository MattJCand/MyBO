<?php include "../../templates/header_page.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Index Page Press</h1>
<a href="../home/home.php"><i class="fas fa-home"></i></a>
<a href="add.php"><i class="fas fa-plus-circle"></i></a>

<?php $reponse = $pdo->query("SELECT presse.titre, presse.dateCrea, presse.description, image.url FROM presse INNER JOIN image ON presse.image_id = image.id" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo $reponse_tableau["titre"]."</br>";
    echo $reponse_tableau["dateCrea"]."</br>";
    echo $reponse_tableau["description"]."</br>";
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
