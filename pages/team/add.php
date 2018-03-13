


<h1 class="align">Ajouter un professeur</h1>
<a href="pages/team/team.php"><i class="fas fa-home"></i></a>

<?php
    // $bdd = "INSERT INTO professeur(nom, prenom, profession, description, mobile, email VALUES (:nom, :prenom, :profession, :description , :mobile , :email )";
$bdd="INSERT INTO professeur(nom_prof, prenom_prof, profession_prof, description_prof, email_prof, tarif_prof) VALUES (:nom, :prenom, :profession, :description, :email, :tarif)";
    $req = $pdo->prepare($bdd);
    $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
    $req->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
    $req->bindParam(':profession', $_POST['profession'], PDO::PARAM_STR);
    $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $req->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $req->bindParam(':tarif', $_POST['tarif'], PDO::PARAM_STR);
    if ($req->execute()) {
       header('Location: team.php');
    }
?>


<form method="post">
  <input name="nom" type="text"  placeholder="Nom" value="<?php  $nom;?>">
  <input name="prenom" type="text"  placeholder="prenom" value="<?php $prenom;?>">
  <input name="profession" type="text"  placeholder="Profession" value="<?php $profession;?>">
  <input name="description" type="text"  placeholder="Description" value="<?php $description;?>">
  <input name="email" type="text"  placeholder="Email" value="<?php $email;?>">
  <input name="tarif" type="text"  placeholder="Tarif" value="<?php $tarif;?>">
  <input type="submit" name="submit" value="submit">
</form>



