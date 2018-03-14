<?php
  require_once "../../inc/inc.php";
?>

<h1 class="align">Edit Page Partenaire</h1>
<a href="pages/partner/partner.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $bdd->query("SELECT partenaire.nom_partenaire, partenaire.description_partenaire, partenaire.adresse_partenaire, partenaire.url_partenaire, partenaire.id_partenaire, image.url_img FROM partenaire INNER JOIN image ON  partenaire.id_image = image.id_img " );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $nom = $reponse_tableau["nom_partenaire"];
      $description = $reponse_tableau["description_partenaire"];
      $adresse = $reponse_tableau["adresse_partenaire"];
      $url = $reponse_tableau["url_partenaire"];
      $img = $reponse_tableau["url_img"];

      // $prep= " UPDATE partenaire SET partenaire.nom = :nom, partenaire.logo = :logo, partenaire.description = :description WHERE partenaire.id = '$id' ";
      // $req = $bdd->prepare($prep);
      // $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
      // $req->bindParam(':logo', $_POST['logo'], PDO::PARAM_STR);
      // $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      // if ($req->execute()) {
      //   header('Location: partner.php');
      // }
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
            <td>Url</td>
            <td><input type="text" name="url" value="<?php echo $url;?>"></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>





