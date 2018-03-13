<?php
require_once "../../inc/menu_2.php";


?>
<main>
  <h1 class="align">Ajouter une actualité</h1>

<a href="../home.php"><i class="fas fa-home"></i></a>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$prep="INSERT INTO actualite(titre_actu, url_actu, description_actu) VALUES (:titre, :url, :description)";
    $req = $bdd->prepare($prep);
    $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
    $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    if ($req->execute()) {
       header('Location: ../actu.php');
    }
?>


  <form method="post" action="#">

    <input name="titre" type="text"  placeholder="titre actu" value="<?php  $titre;?>">

    <input name="description" type="text"  placeholder="description actualite" value="<?php $description;?>">

    <input name="url" type="text"  placeholder="url actualite" value="<?php $url;?>">

    <input type="submit" name="submit" value="submit">

  </form>

</main>
