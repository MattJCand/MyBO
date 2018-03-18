<?php
require_once '../inc/inc.php';
// clearstatcache();

  $req="SELECT *, date_format(date_debut, '%d/%m/%Y') AS date_fr FROM actualite a, image i, date d WHERE a.id_image= i.id_img AND a.id_date=d.id_date";
  $reponse_req = $bdd->query($req);

include "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Gestion des actualités</h1>
  <div class="bloc-btn-creation">
    <a href="actu/add.php" class="majuscule btn-creation">Ajouter <i class="fas fa-plus-circle"></i></a>
  </div>

  <?php
    if($reponse_req->rowCount()>=1){
  ?>
     <table class="table-actu">
      <thead>
         <tr>
          <th>Image</th>
          <th>Titre</th>
          <th>Description</th>
          <th>Site internet</th>
          <th>Date</th>
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
          <td class="img_table "><img class="img-adapte" src="../upload_img/<?php echo $reponse_tableau["url_img"] ?>" alt="<?php echo $reponse_tableau["url_img"] ?>"></td>
          <td class="titre_table"><?php echo $reponse_tableau["titre_actu"] ?></td>
          <td class="description-table description-table-actu"><?php echo $reponse_tableau["description_actu"] ?></td>
          <td class="url_table"><a href="https://<?php echo $reponse_tableau["url_actu"] ?>" target="blank"><?php echo $reponse_tableau["url_actu"] ?></a></td>
          <td class="date_table"><?php echo $reponse_tableau["date_fr"] ?></td>
          <td>
            <a href="actu/edit.php?id=<?php echo $reponse_tableau["id_actu"]; ?>">
              <i class='fas fa-edit'></i>
            </a>
          </td>
          <td>
            <a href="actu/delete.php?id=<?php echo $reponse_tableau["id_actu"]; ?>">
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



