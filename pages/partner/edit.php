<?php include "../../templates/header_page.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Edit Page Partenaire</h1>
<a href="../partner/partner.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT partenaire.id, partenaire.nom, partenaire.adresse, partenaire.description, partenaire.offre, image.url FROM partenaire INNER JOIN image ON partenaire.image_id = image.id WHERE partenaire.id = $id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $nom = $reponse_tableau["nom"];
      $adresse = $reponse_tableau["adresse"];
      $description = $reponse_tableau["description"];
      $offre = $reponse_tableau["offre"];

      $bdd= " UPDATE partenaire SET partenaire.nom = :nom, partenaire.adresse = :adresse, partenaire.description = :description, partenaire.offre = :offre WHERE partenaire.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
      $req->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      $req->bindParam(':offre', $_POST['offre'], PDO::PARAM_STR);
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
            <td>Adresse</td>
            <td><input type="text" name="adresse" value="<?php echo $adresse;?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" name="description" value="<?php echo $description;?>"></td>
        </tr>
        <tr>
            <td>Offre</td>
            <td><input type="text" name="offre" value="<?php echo $offre;?>"></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>




<?php include "../../templates/footer.php"; ?>
