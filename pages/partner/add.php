<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>


<h1 class="align">Ajouter un partenaire</h1>
<a href="pages/partner/partner.php"><i class="fas fa-home"></i></a>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$bdd="INSERT INTO partenaire(nom, logo, description) VALUES (:nom, :logo, :description)";
    $req = $pdo->prepare($bdd);
    $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
    $req->bindParam(':logo', $_POST['logo'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    if ($req->execute()) {
       header('Location: partner.php');
    }
?>


<form method="post">
  <input name="nom" type="text"  placeholder="nom" value="<?php $nom;?>">
  <input name="logo" type="text" placeholder="logo"  value="<?php $logo;?>">
  <input name="description" type="text"  placeholder="Description" value="<?php $description;?>">
  <input type="submit" name="submit" value="submit">
</form>


<?php include "../../templates/footer.php"; ?>

