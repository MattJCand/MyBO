<?php include "../../templates/header_page.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Edit Page Press</h1>
<a href="../team/team.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT presse.titre, presse.dateCrea, presse.description, image.url FROM presse INNER JOIN image ON presse.image_id = image.id WHERE presse.id = $id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $titre = $reponse_tableau["titre"];
      $dateCrea = $reponse_tableau["dateCrea"];
      $description = $reponse_tableau["description"];


      $bdd= " UPDATE presse SET presse.titre = :titre, presse.titre = :titre, presse.dateCrea = :dateCrea, presse.description = :description WHERE presse.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
      $req->bindParam(':dateCrea', $_POST['dateCrea'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
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
            <td>Date Création</td>
            <td><input type="date" name="dateCrea" value="<?php echo $dateCrea;?>"></td>
        </tr>
        <tr>
            <td>description</td>
            <td><input type="text" name="description" value="<?php echo $description;?>"></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>



<?php include "../../templates/footer.php"; ?>
