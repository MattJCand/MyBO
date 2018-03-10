<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Edit Page Partenaire</h1>
<a href="pages/partner/partner.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT partenaire.id, partenaire.nom, partenaire.description, partenaire.logo FROM partenaire WHERE partenaire.id = $id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $nom = $reponse_tableau["nom"];
      $logo = $reponse_tableau["logo"];
      $description = $reponse_tableau["description"];

      $bdd= " UPDATE partenaire SET partenaire.nom = :nom, partenaire.logo = :logo, partenaire.description = :description WHERE partenaire.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
      $req->bindParam(':logo', $_POST['logo'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      if ($req->execute()) {
        header('Location: partner.php');
      }
  }
?>

<form  method="post">
    <table border="0">
        <tr>
            <td>Nom</td>
            <td><input type="text" name="nom" value="<?php echo $nom;?>"></td>
        </tr>
        <tr>
            <td>Logo</td>
            <td><input type="text" name="logo" value="<?php echo $logo;?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" name="description" value="<?php echo $description;?>"></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>




<?php include "../../templates/footer.php"; ?>
