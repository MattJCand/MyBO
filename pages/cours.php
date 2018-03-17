<?php
require_once '../inc/inc.php';

  $req="SELECT * FROM cours ";
  $reponse_req = $bdd->query($req);

include "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Gestion des Cours</h1>
  <?php
    if($reponse_req->rowCount()>=1){
  ?>
     <table class="table-cours">
      <thead>
         <tr>
          <th>Intitule</th>
          <th>Description</th>
          <th>Heure de debut</th>
          <th>Heure de fin</th>
          <th>Jour prevu</th>
          <th colspan=2>Gestion</th>

        </tr>
      </thead>
  <?php

    while ( $reponse_tableau = $reponse_req->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <tbody>
        <tr>
          <td class="titre_table"><?php echo $reponse_tableau["intitule_cours"] ?></td>
          <td class="description-table description-table-cours"><?php echo $reponse_tableau["description_cours"] ?></td>
          <td>
            <a href="cours/edit.php?id=<?php echo $reponse_tableau["id_cours"]; ?>">
              <i class='fas fa-edit'></i>
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






