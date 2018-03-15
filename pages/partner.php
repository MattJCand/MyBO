<?php
require_once '../inc/inc.php';

  $req_select_partenaire="SELECT * FROM partenaire p, image i WHERE a.id_image= i.id_img";
  $recherche_req_select_partenaire = $bdd->query($req_select_partenaire);

require_once "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Partenaires</h1>
   <div class="bloc-btn-creation">
      <a href="partenaire/add.php" class="majuscule btn-creation">Ajouter <i class="fas fa-plus-circle"></i></a>
    </div>

  <?php
    if($recherche_req_select_partenaire->rowCount()>=1){
  ?>
     <table class="table-partenaire">
      <thead>
         <tr>
          <th>Image</th>
          <th>Nom</th>
          <th>Description</th>
          <th>Adresse</th>
          <th>Url</th>
          <th colspan=2>Gestion</th>

        </tr>
      </thead>
  <?php

    while ( $reponse_tableau = $reponse_req->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <tbody>
        <tr>
        <td class="nom_partenaire"><?php echo $reponse_tableau["nom_partenaire"] ?></td>
        <td class="description_partenaire"><?php echo $reponse_tableau["description_partenaire"] ?></td>
        <td class="adresse_partenaire"><?php echo $reponse_tableau["adresse_partenaire"] ?></td>
        <td class="url_partenaire"><?php echo $reponse_tableau["url_partenaire"] ?></td>
        <td>
          <a href="partner/edit.php?id=<?php echo $reponse_tableau["id_partenaire"] ?>">
            <i class='fas fa-edit'></i>
          </a>
        </td>
        <td>
          <a href="partner/delete.php?id=<?php echo $reponse_tableau["id_partenaire"]?>" onClick=" confirm('Are you sure you want to delete?')">
            <i class='fas fa-trash'></i>
          </a>
        </td>
      </tr>

  <?php
    }
  ?>
    </tbody>
  <table>
</main>
<?php
}
?>


