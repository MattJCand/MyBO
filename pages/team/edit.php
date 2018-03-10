<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Edit Page Equipe</h1>
<a href="pages/team/team.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT professeur.nom, professeur.prenom, professeur.profession, professeur.description, professeur.email, professeur.image_profil FROM professeur WHERE professeur.id = $id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $prenom = $reponse_tableau["prenom"];
      $nom = $reponse_tableau["nom"];
      $profession = $reponse_tableau["profession"];
      $description = $reponse_tableau["description"];
      $email = $reponse_tableau["email"];
      $image_profil = $reponse_tableau["image_profil"];

      $bdd= " UPDATE professeur SET professeur.nom = :nom, professeur.prenom = :prenom, professeur.profession = :profession, professeur.description = :description, professeur.image_profil = :image_profil, professeur.email = :email WHERE professeur.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
      $req->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
      $req->bindParam(':profession', $_POST['profession'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      $req->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
      $req->bindParam(':image_profil', $_POST['image_profil'], PDO::PARAM_STR);
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
            <td>image_profil</td>
            <td><input type="text" name="image_profil" value="<?php echo $image_profil;?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>



<?php include "../../templates/footer.php"; ?>
