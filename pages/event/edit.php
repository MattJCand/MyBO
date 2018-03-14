<?php
require_once '../../inc/header.php';
require_once '../../inc/securite.php';
require_once "../../inc/menu.php";
?>

<h1 class="align">Edit Page Event</h1>
<a href="pages/event/event.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $bdd->query("SELECT lieu_event, nom_event, description_event, url_event FROM evenement " );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $nom = $reponse_tableau["nom_event"];
      $description = $reponse_tableau["description_event"];
      $url = $reponse_tableau["url_event"];
      $lieu = $reponse_tableau["lieu_event"];

      $prep= " UPDATE evenement SET evenement.nom_event = :nom,
      evenement.description_event = :description, evenement.url_event = :url, evenement.lieu_event = :lieu WHERE evenement.id_event = '$id' ";
      $req = $bdd->prepare($prep);
      $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
      $req->bindParam(':lieu', $_POST['lieu'], PDO::PARAM_STR);
    }
?>

<?php
    $reponse = $bdd->query("SELECT url_img FROM image " );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $url_img = $reponse_tableau["url_img"];

      $prep= " UPDATE image SET image.url_img = :url_img WHERE image.id_event = :id ";
      $req = $bdd->prepare($prep);
      $req->bindParam(':url_img', $_POST['url_img'], PDO::PARAM_STR);
      $req->bindParam(':id', $id, PDO::PARAM_STR);
    }
?>

<form  method="post">
    <table border="0">
        <tr>
            <td>Nom</td>
            <td><input type="text" name="nom" value="<?php echo $nom;?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" name="description" value="<?php echo $description;?>"></td>
        </tr>
        <tr>
            <td>Url</td>
            <td><input type="texte" name="url" value="<?php echo $url;?>"></td>
        </tr>
        <tr>
            <td>Lieu</td>
            <td><input type="texte" name="lieu" value="<?php echo $lieu;?>"></td>
        </tr>
        <tr>
            <td><input type="file" name="url_img" value="<?php echo $url_img;?>"></td>
        </tr>
        <tr>
            <td><input type="date" name="url_img" value="<?php echo $url_img;?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>
