<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Edit Page Partenaire</h1>
<a href="pages/cours/cours.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT cours.intitule, cours.description, cours.tarif, professeur.id, cours.id FROM cours INNER JOIN professeur ON cours.professeur_id = professeur.id INNER JOIN image ON professeur.image_id = image.id" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $intitule = $reponse_tableau["intitule"];
      $description = $reponse_tableau["description"];
      $tarif = $reponse_tableau["tarif"];
      $bdd= " UPDATE cours SET cours.intitule = :intitule, cours.description = :description, cours.tarif = :tarif WHERE cours.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':intitule', $_POST['intitule'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      $req->bindParam(':tarif', $_POST['tarif'], PDO::PARAM_STR);
      if ($req->execute()) {
        header('Location: cours.php');
      }
  }
?>

<form  method="post">
    <table border="0">
        <tr>
            <td>Intitule</td>
            <td><input type="text" name="intitule" value="<?php echo $intitule;?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" name="description" value="<?php echo $description;?>"></td>
        </tr>
        <tr>
            <td>Tarif</td>
            <td><input type="text" name="tarif" value="<?php echo $tarif;?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>


<?php include "../../templates/footer.php"; ?>
