<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Edit Page Equipe</h1>
<a href="pages/team/team.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT actualite.titre, actualite.description, actualite.url, actualite.id FROM actualite WHERE actualite.id = $id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $titre = $reponse_tableau["titre"];
      $description = $reponse_tableau["description"];
      $url = $reponse_tableau["url"];

      $bdd= " UPDATE actualite SET actualite.titre = :titre, actualite.description = :description, actualite.url = :url WHERE actualite.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
      if ($req->execute()) {
       header('Location: actu.php');
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



<?php include "../../templates/footer.php"; ?>
