

<h1 class="align">Edit Page Equipe</h1>
<a href="pages/team/team.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT Professeur.nom_prof, Professeur.prenom_prof, Professeur.profession_prof, Professeur.description_prof, Professeur.email_prof, Professeur.tarif_prof FROM Professeur WHERE Professeur.id_prof = $id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $prenom = $reponse_tableau["prenom_prof"];
      $nom = $reponse_tableau["nom_prof"];
      $profession = $reponse_tableau["profession_prof"];
      $description = $reponse_tableau["description_prof"];
      $email = $reponse_tableau["email_prof"];
      $image_profil = $reponse_tableau["tarif_prof"];

      $bdd= " UPDATE Professeur SET Professeur.nom_prof = :nom, Professeur.prenom_prof = :prenom, Professeur.profession_prof = :profession, Professeur.description_prof = :description, Professeur.email_prof = :email, Professeur.tarif_prof = :tarif WHERE Professeur.id_prof = '$id' ";
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
  }
?>

<form  method="post">
    <table border="0">
        <tr>
            <td>Prenom</td>
            <td><input type="text" name="prenom" value="<?php echo $prenom;?>"></td>
        </tr>
        <tr>
            <td>Nom</td>
            <td><input type="text" name="nom" value="<?php echo $nom;?>"></td>
        </tr>
        <tr>
            <td>Profession</td>
            <td><input type="text" name="profession" value="<?php echo $profession;?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" name="description" value="<?php echo $description;?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $email;?>"></td>
        </tr>
        <tr>
            <td>Tarif Cours</td>
            <td><input type="text" name="tarif" value="<?php echo $tarif;?>"></td>
        </tr>
        <tr>
          <td><input type="text" name="id" value="<?php echo $_GET['id'];?>"></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>




