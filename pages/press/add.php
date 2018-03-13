

<h1 class="align">Ajouter un article de presse</h1>
<a href="pages/press/press.php"><i class="fas fa-home"></i></a>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$bdd="INSERT INTO presse(titre, dateCrea, description, image_id) VALUES (:titre, :dateCrea, :description,1)";
    $req = $pdo->prepare($bdd);
    $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
    $req->bindParam(':dateCrea', $_POST['dateCrea'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    if ($req->execute()) {
       header('Location: press.php');
    }
?>


<form method="post">
  <input name="titre" type="text"  placeholder="titre" value="<?php $titre;?>">
  <input name="dateCrea" type="date"  value="<?php $dateCrea;?>">
  <input name="description" type="text"  placeholder="Description" value="<?php $description;?>">
  <input type="submit" name="submit" value="submit">
</form>



