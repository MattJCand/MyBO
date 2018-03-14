<?php
  require_once "../../inc/menu_2.php";
?>

<h1 class="align">Edit Page Membre</h1>
<a href="pages/member/member.php"><i class="fas fa-home"></i></a>

<?php

      $id = $_GET['id'];

      $reponse = $bdd->query("SELECT membre.description, membre.prix_enfant, membre.prix_adulte, FROM membre  WHERE membre.id = $id" );
      while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
      $description = $reponse_tableau["description"];
      $prix_enfant = $reponse_tableau["prix_enfant"];
      $prix_adulte = $reponse_tableau["prix_adulte"];

    //   $bdd= " UPDATE membre SET membre.description = :description, membre.prix_enfant = :prix_enfant, membre.prix_adulte = :prix_adulte WHERE membre.id = '$id' ";
    //   $req = $pdo->prepare($bdd);
    //   $req->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    //   $req->bindParam(':prix_enfant', $_POST['prix_enfant'], PDO::PARAM_STR);
    //   $req->bindParam(':prix_adulte', $_POST['prix_adulte'], PDO::PARAM_STR);
    //   if ($req->execute()) {
    //    header('Location: member.php');
    // }
  }
?>

<form  method="post">
    <table border="0">
        <tr>
            <td>Description</td>
            <td><input type="text" name="description" value="<?php echo $description;?>"></td>
        </tr>
        <tr>
            <td>Prix Enfant</td>
            <td><input type="text" name="prix_enfant" value="<?php echo $prix_enfant;?>"></td>
        </tr>
        <tr>
            <td>Prix Adulte</td>
            <td><input type="text" name="prix_adulte" value="<?php echo $prix_adulte;?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit">
</form>



