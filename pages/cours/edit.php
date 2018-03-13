
<?php
require_once '../../inc/header.php';
require_once '../../inc/securite.php';
require_once "../../inc/menu.php"; ?>
<h1 class="align">Edit Page Partenaire</h1>
<a href="pages/cours/cours.php"><i class="fas fa-home"></i></a>

<?php $id = $_GET['id']; ?>

<?php
    $reponse = $bdd->query("SELECT intitule_cours, description_cours, id_cours FROM cours" );
    while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $intitule = $reponse_tableau["intitule_cours"];
      $description = $reponse_tableau["description_cours"];
      $prep= " UPDATE cours SET intitule_cours = :intitule, description_cours = :description WHERE id_cours = '$id' ";
      $req = $bdd->prepare($prep);
      $req->bindParam(':intitule', $_POST['intitule'], PDO::PARAM_STR);
      $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
      if ($req->execute()) {
        header('Location: ../cours.php');
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
