<?php
require_once '../inc/inc.php';

  $req="SELECT * FROM professeur p, image i WHERE p.id_image= i.id_img";
  $reponse_req = $bdd->query($req);

include "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Gestion des professeurs</h1>
  <div class="bloc-btn-creation">
    <a href="team/add.php" class="majuscule btn-creation">Ajouter <i class="fas fa-plus-circle"></i></a>
  </div>

  <?php
    if($reponse_req->rowCount()>=1){
  ?>
     <table class="table-professeur">
    <thead>
       <tr>
        <th>Image</th>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Profession</th>
        <th>Description</th>
        <th>Email</th>
        <th>Tarif Professeur</th>
        <th colspan=2>Gestion</th>
      </tr>
    </thead>
  <?php

    while ( $reponse_tableau = $reponse_req->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <tbody>
        <tr>
          <td class="img_table"><img src="<?php echo $reponse_tableau["url_img"] ?>" alt="<?php echo $reponse_tableau["url_img"] ?>"></td>
          <td class="nom_table"><?php echo $reponse_tableau["nom_prof"] ?></td>
          <td class="prenom_table"><?php echo $reponse_tableau["prenom_prof"] ?></td>
          <td class="description-table description-table-professeur"><?php echo $reponse_tableau["description_prof"] ?></td>
          <td class="email_table"><?php echo $reponse_tableau["email_prof"] ?></td>
          <td class="profession_table"><?php echo $reponse_tableau["profession_prof"] ?></td>
          <td class="tarif_table"><?php echo $reponse_tableau["tarif_prof"] ?></td>
          <td>
            <a href="team/edit.php?id=<?php echo $reponse_tableau["id_prof"]; ?>">
              <i class='fas fa-edit'></i>
            </a>
          </td>
          <td>
            <a href="team/delete.php?id=<?php echo $reponse_tableau["id_prof"]; ?>">
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
