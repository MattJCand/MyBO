<?php
require_once '../../inc/header.php';
require_once '../../inc/securite.php';
require_once "../../inc/menu.php";
?>

<h1 class="align">Ajouter un evenement</h1>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$prep="INSERT INTO evenement( nom_event, description_event, lieu_event, url_event) VALUES ( :nom, :description, :lieu, :url)";
    $req = $bdd->prepare($prep);
    $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $req->bindParam(':lieu', $_POST['lieu'], PDO::PARAM_STR);
    $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
    $req->execute();

$prep="INSERT INTO image(url_img) VALUES (:url_img)";
    $req = $bdd->prepare($prep);
    $req->bindParam(':url_img', $_POST['url_img'], PDO::PARAM_STR);
    $req->execute();

$prep="INSERT INTO date(date_debut, date_fin) VALUES (:date_debut, :date_fin)";
    $req = $bdd->prepare($prep);
    $req->bindParam(':date_debut', $_POST['date_debut'], PDO::PARAM_STR);
    $req->bindParam(':date_fin', $_POST['date_fin'], PDO::PARAM_STR);
    $req->execute();

$prep="INSERT INTO horaire( heure_debut, heure_fin) VALUES ( :heure_debut, :heure_fin)";
    $req = $bdd->prepare($prep);
    $req->bindParam(':heure_debut', $_POST['heure_debut'], PDO::PARAM_STR);
    $req->bindParam(':heure_fin', $_POST['heure_fin'], PDO::PARAM_STR);
    $req->execute();
?>

<form method="post">
  <input name="nom" type="text" placeholder="Nom" value="<?php $nom;?>">
  <input name="description" type="text"  placeholder="Description Evenement" value="<?php $description;?>">
  <input name="lieu" type="text" placeholder="Lieu Evenement" value="<?php $lieu;?>">
  <input name="url" type="text"  placeholder="Url Evenement" value="<?php $url;?>">
  <input name="url" type="file"  value="<?php $url_img;?>">
  <input name="date_debut" type="date" value="<?php $date_debut;?>">
  <input name="date_fin" type="date" value="<?php $date_fin;?>">
  <input name="horaire_debut" type="date" value="<?php $heure_debut;?>">
  <input name="horaire_fin" type="date" value="<?php $heure_fin;?>">
  <input type="submit" name="submit" value="submit">
</form>
