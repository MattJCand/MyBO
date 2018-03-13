

<h1 class="align">Edit Page Press</h1>
<a href="pages/press/press.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT presse.titre, presse.description, presse.url, presse.image FROM presse WHERE presse.id = $id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $titre = $reponse_tableau["titre"];
      $url = $reponse_tableau["url"];
      $description = $reponse_tableau["description"];
      $image = $reponse_tableau["image"];


      $bdd= " UPDATE presse SET presse.titre = :titre, presse.description = :description, presse.url = :url, presse.image = :image WHERE presse.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
      $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
         $req->bindParam(':image', $_POST['image'], PDO::PARAM_STR);
      if ($req->execute()) {
       header('Location: press.php');
    }
  }
?>

<form  method="post">
    <table border="0">
        <tr>
            <td>Titre</td>
            <td><input type="text" name="titre" value="<?php echo $titre;?>"></td>
        </tr>
        <tr>
            <td>Url</td>
            <td><input type="text" name="url" value="<?php echo $url;?>"></td>
        </tr>
        <tr>
            <td>description</td>
            <td><input type="text" name="description" value="<?php echo $description;?>"></td>
        </tr>
        <tr>
            <td>image</td>
            <td><input type="text" name="image" value="<?php echo $image;?>"></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>



