<?php include "../../templates/header_page.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Ajouter un professeur</h1>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$bdd="INSERT INTO professeur(nom, prenom, profession, description, mobile, email, image_id) VALUES (:nom, :prenom, :profession, :description, :mobile , :email, 1)";
    $req = $pdo->prepare($bdd);
    $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
    $req->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
    $req->bindParam(':profession', $_POST['profession'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $req->bindParam(':mobile', $_POST['mobile'], PDO::PARAM_STR);
    $req->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    if ($req->execute()) {
       header('Location: team.php');
    }
?>


<form method="post">
  <input name="nom" type="text"  placeholder="Nom" value="<?php  $nom;?>">
  <input name="prenom" type="text"  placeholder="prenom" value="<?php $prenom;?>">
  <input name="profession" type="text"  placeholder="Profession" value="<?php $profession;?>">
  <input name="description" type="text"  placeholder="Description" value="<?php $description;?>">
  <input name="mobile" type="text"  placeholder="Mobile" value="<?php $mobile;?>">
  <input name="email" type="text"  placeholder="Email" value="<?php $email;?>">
  <input type="submit" name="submit" value="submit">
</form>


<?php include "../../templates/footer.php"; ?>
