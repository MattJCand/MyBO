<?php
  require_once "../../inc/menu_2.php";
?>

<h1 class="align">Edit Page Actualité</h1>
<a href="../actu.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $bdd->query("SELECT actualite.titre_actu, actualite.description_actu, actualite.url_actu, actualite.id_actu  FROM actualite WHERE actualite.id_actu = $id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $titre = $reponse_tableau["titre_actu"];
      $description = $reponse_tableau["description_actu"];
      $url = $reponse_tableau["url_actu"];

    //   $bdd= " UPDATE actualite SET actualite.titre = :titre, actualite.description = :description, actualite.url = :url WHERE actualite.id = '$id' ";
    //   $req = $pdo->prepare($bdd);
    //   $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
    //   $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    //   $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
    //   if ($req->execute()) {
    //    header('Location: actu.php');
    // }
  }
?>

<form  method="post">
    <table border="0">
        <tr>
            <td>Titre</td>
            <td><input type="text" name="titre" value="<?php echo $titre;?>"></td>
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


