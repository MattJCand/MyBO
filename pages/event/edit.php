<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Edit Page Event</h1>
<a href="pages/event/event.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT evenement.titre, evenement.dateCrea, evenement.description, evenement.url,evenement.id FROM evenement INNER JOIN image ON evenement.image_id = image.id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $titre = $reponse_tableau["titre"];
      $dateCrea = $reponse_tableau["dateCrea"];
      $description = $reponse_tableau["description"];
      $url = $reponse_tableau["url"];

      $bdd= " UPDATE evenement SET evenement.titre = :titre, evenement.dateCrea = :dateCrea, evenement.description =  :description, evenement.url = :url WHERE evenement.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
      $req->bindParam(':dateCrea', $_POST['dateCrea'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      $req->bindParam(':url', $_POST['url'], PDO::PARAM_STR);
      if ($req->execute()) {
       header('Location: event.php');
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
            <td>Date Création</td>
            <td><input type="date" name="dateCrea" value="<?php echo $dateCrea;?>"></td>
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
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>



<?php include "../../templates/footer.php"; ?>
