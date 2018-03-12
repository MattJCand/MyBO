<?php include "../../templates/header.php"; ?>
<?php include "../../admin/session.php"; ?>
<?php include "../../templates/pdo.php"; ?>

<h1 class="align">Edit Page Partenaire</h1>
<a href="pages/cours/cours.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $pdo->query("SELECT cours.intitule_cours, cours.description_cours, cours.id FROM Cours" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $intitule = $reponse_tableau["intitule_cours"];
      $description = $reponse_tableau["description_cours"];
      $bdd= " UPDATE cours SET cours.intitule_cours = :intitule, cours.description_cours = :description WHERE cours.id = '$id' ";
      $req = $pdo->prepare($bdd);
      $req->bindParam(':intitule', $_POST['intitule'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
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
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>


<?php include "../../templates/footer.php"; ?>
