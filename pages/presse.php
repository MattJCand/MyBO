<?php
require_once '../inc/inc.php';

  $req="SELECT *  FROM presse p, image i WHERE p.id_image= i.id_img";
  $reponse_req = $bdd->query($req);

include "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Gestion des articles de Presse</h1>
  <div class="bloc-btn-creation">
    <a href="press/add.php" class="majuscule btn-creation">Ajouter <i class="fas fa-plus-circle"></i></a>
  </div>

  <?php
    if($reponse_req->rowCount()>=1){
  ?>
     <table class="table-presse">
      <thead>
         <tr>
          <th>Image</th>
          <th>Titre</th>
          <th>Description</th>
          <th>Url de l'article</th>
          <th colspan=2>Gestion</th>
        </tr>
      </thead>
  <?php

    while ( $reponse_tableau = $reponse_req->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <tbody>
        <tr>
          <?php
        #$logo = $reponse_tableau["url_img"];
        #$imageData = base64_encode(file_get_contents($logo));
        #echo '<td><img class="img_actu" src="data:image/jpeg;base64,'.$imageData.'"></td>';
        ?>
          <td class="img_table"><img class="img-adapte" src="../upload_img/presse/<?php echo $reponse_tableau["url_img"] ?>" alt="<?php echo $reponse_tableau["url_img"] ?>"></td>
          <td class="titre_table"><?php echo $reponse_tableau["titre_presse"] ?></td>
          <td class="description-table description-table-actu"><?php echo $reponse_tableau["description_presse"] ?></td>
          <td class="url_table"><a href="https://<?php echo $reponse_tableau["url_presse"] ?>" target="blank"><?php echo $reponse_tableau["url_presse"] ?></a></td>
          <td>
            <a href="press/edit.php?id=<?php echo $reponse_tableau["id_presse"]; ?>">
              <i class='fas fa-edit'></i>
            </a>
          </td>
          <td>
            <a href="press/delete.php?id=<?php echo $reponse_tableau["id_presse"]; ?>">
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

include "../inc/footer.php";
?>



