<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Ajouter un evenement</h1>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$bdd="INSERT INTO evenement(titre, dateCrea, description, url, image_id) VALUES (:titre, :dateCrea, :description, :url, 1)";
    $req = $pdo->prepare($bdd);
    $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
    $req->bindParam(':dateCrea', $_POST['dateCrea'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
    if ($req->execute()) {
       header('Location: event.php');
    }
?>


<form method="post">
  <input name="titre" type="text"  placeholder="titre" value="<?php $titre;?>">
  <input name="dateCrea" type="date" value="<?php $dateCrea;?>">
  <input name="description" type="text"  placeholder="Description" value="<?php $description;?>">
  <input name="url" type="text"  placeholder="Url" value="<?php $url;?>">
  <input type="submit" name="submit" value="submit">
</form>


<?php include "../../templates/footer.php"; ?>

