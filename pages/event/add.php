
<h1 class="align">Ajouter un evenement</h1>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$bdd="INSERT INTO evenement(image, nom, description, lieu, url, horaire_id) VALUES (:image, :nom, :description, :lieu, :url, 1)";
    $req = $pdo->prepare($bdd);
    $req->bindParam(':image', $_POST['image'], PDO::PARAM_STR);
    $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $req->bindParam(':lieu', $_POST['lieu'], PDO::PARAM_STR);
    $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
    if ($req->execute()) {
       header('Location: event.php');
    }
?>


<form method="post">
  <input name="image" type="text"  placeholder="image" value="<?php $image;?>">
  <input name="nom" type="text" value="<?php $nom;?>">
  <input name="description" type="text"  placeholder="Description" value="<?php $description;?>">
  <input name="lieu" type="text" value="<?php $lieu;?>">
  <input name="url" type="text"  placeholder="Url" value="<?php $url;?>">
  <input type="submit" name="submit" value="submit">
</form>



