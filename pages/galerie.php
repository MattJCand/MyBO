<?php
require_once '../inc/inc.php';

  $req="SELECT * FROM  image i";
  $reponse_req = $bdd->query($req);

include "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Gestion des Images</h1>
  <div class="bloc-btn-creation">
    <a href="galerie/add.php" class="majuscule btn-creation">Ajouter <i class="fas fa-plus-circle"></i></a>
  </div>

  <?php
    if($reponse_req->rowCount()>=1){
  ?>
     <table class="table-galerie">
    <thead>
       <tr>
        <th>Url Image</th>
        <th>Date création Image</th>
        <th colspan=2>Gestion</th>
      </tr>
    </thead>
  <?php

    while ( $reponse_tableau = $reponse_req->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <tbody>
        <tr>
          <td class="img_table"><img src="<?php echo $reponse_tableau["url_img"] ?>" alt="<?php echo $reponse_tableau["url_img"] ?>"></td>
          <td class="date_image_table"><?php echo $reponse_tableau["date_creation_img"] ?></td>
          <td>
            <a href="galerie/edit.php?id=<?php echo $reponse_tableau["id_img"]; ?>">
              <i class='fas fa-edit'></i>
            </a>
          </td>
          <td>
            <a href="galerie/delete.php?id=<?php echo $reponse_tableau["id_img"]; ?>">
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
