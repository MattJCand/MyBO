

<h1 class="align">Ajouter une actualité</h1>
<a href="pages/actu/actu.php"><i class="fas fa-home"></i></a>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$bdd="INSERT INTO actualite(titre, description, url) VALUES (:titre, :description, :url)";
    $req = $pdo->prepare($bdd);
    $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
    if ($req->execute()) {
       header('Location: actu.php');
    }
?>


<form method="post">
  <input name="titre" type="text"  placeholder="titre actu" value="<?php  $titre;?>">
  <input name="description" type="text"  placeholder="description" value="<?php $description;?>">
  <input name="url" type="text"  placeholder="url evenement" value="<?php $url;?>">
  <input type="submit" name="submit" value="submit">
</form>



