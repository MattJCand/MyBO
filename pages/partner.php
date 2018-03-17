<?php
require_once '../inc/inc.php';

  $req_select_partenaire="SELECT * FROM partenaire p, image i WHERE p.id_image= i.id_img";
  $recherche_req_select_partenaire = $bdd->query($req_select_partenaire);

require_once "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Gestion des partenaires</h1>
   <div class="bloc-btn-creation">
      <a href="partner/add.php" class="majuscule btn-creation">Ajouter <i class="fas fa-plus-circle"></i></a>
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
          <th>Site internet</th>
          <th colspan=2>Gestion</th>

        </tr>
      </thead>
  <?php

    while ( $reponse_tableau = $recherche_req_select_partenaire->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <tbody>
        <tr>
          <td class="img_table">
            <img src="<?php echo $reponse_tableau["url_img"] ?>" alt="<?php echo $reponse_tableau["url_img"] ?>">
          </td>
          <td class="nom_table"><?php echo $reponse_tableau["nom_partenaire"] ?></td>
          <td class="description-table description-table-partenaire"><?php echo $reponse_tableau["description_partenaire"] ?></td>
          <td class="adresse_table"><?php echo $reponse_tableau["adresse_partenaire"] ?></td>
          <td class="url_table"><a href="https://<?php echo $reponse_tableau["url_partenaire"]; ?>" target="blank" ><?php echo $reponse_tableau["url_partenaire"] ?></a></td>
          <td>
            <a href="partner/edit.php?id=<?php echo $reponse_tableau["id_partenaire"] ?>">
              <i class='fas fa-edit'></i>
            </a>
          </td>
          <td>
            <a href="partner/delete.php?id=<?php echo $reponse_tableau["id_partenaire"]?>">
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


