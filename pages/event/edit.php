

<h1 class="align">Edit Page Event</h1>
<a href="pages/event/event.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT evenement.image, evenement.nom, evenement.description, evenement.url,
      evenement.lieu, evenement.id FROM evenement " );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $image = $reponse_tableau["image"];
      $nom = $reponse_tableau["nom"];
      $description = $reponse_tableau["description"];
      $url = $reponse_tableau["url"];
      $lieu = $reponse_tableau["lieu"];

      $bdd= " UPDATE evenement SET evenement.image = :image, evenement.nom = :nom,
      evenement.description = :description, evenement.url = :url, evenement.lieu = :lieu WHERE evenement.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':image', $_POST['image'], PDO::PARAM_STR);
      $req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
      $req->bindParam(':lieu', $_POST['lieu'], PDO::PARAM_STR);
      if ($req->execute()) {
       header('Location: event.php');
    }
  }
?>

<form  method="post">
    <table border="0">
        <tr>
            <td>Image</td>
            <td><input type="text" name="image" value="<?php echo $image;?>"></td>
        </tr>
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
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>




