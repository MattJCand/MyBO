<?php
require_once '../inc/inc.php';

  $req="SELECT *, date_format(date_debut, '%d/%m/%Y') AS date_fr FROM evenement e, image i, date d, horaire h WHERE e.id_image= i.id_img AND e.id_date=d.id_date AND e.id_horaire=h.id_horaire";
  $reponse_req = $bdd->query($req);

include "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Gestion des evenements</h1>
  <div class="bloc-btn-creation">
    <a href="event/add.php" class="majuscule btn-creation">Ajouter <i class="fas fa-plus-circle"></i></a>
  </div>

  <?php
    if($reponse_req->rowCount()>=1){
  ?>
     <table class="table-actu">
      <thead>
         <tr>
          <th>Image</th>
          <th>Nom</th>
          <th>Description</th>
          <th>Lieu</th>
          <th>Site</th>
          <th>Date</th>
          <th>Heure debut</th>
          <th>Heure de fin</th>
          <th colspan=2>Gestion</th>

        </tr>
      </thead>
  <?php

    while ( $reponse_tableau = $reponse_req->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <tbody>
        <tr>
          <td class="img_table"><img src="<?php echo $reponse_tableau["url_img"] ?>" alt="<?php echo $reponse_tableau["url_img"] ?>"></td>
          <td class="titre_table"><?php echo $reponse_tableau["nom_event"] ?></td>
          <td class="description-table description-table-event"><?php echo $reponse_tableau["description_event"] ?></td>
          <td class="lieu_table"><?php echo $reponse_tableau["lieu_event"] ?></td>
          <td class="url_table"><a href="http://<?php echo $reponse_tableau["url_event"] ?>"><?php echo $reponse_tableau["url_event"] ?></a></td>
          <td class="date_table"><?php echo $reponse_tableau["date_fr"] ?></td>
          <td class="date_table"><?php echo $reponse_tableau["heure_debut"] ?></td>
          <td class="date_table"><?php echo $reponse_tableau["heure_fin"] ?></td>
          <td>
            <a href="event/edit.php?id=<?php echo $reponse_tableau["id_event"]; ?>">
              <i class='fas fa-edit'></i>
            </a>
          </td>
          <td>
            <a href="event/delete.php?id=<?php echo $reponse_tableau["id_event"]; ?>">
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






