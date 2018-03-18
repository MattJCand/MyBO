<?php
require_once '../inc/inc.php';

  $req="SELECT *  FROM tarif_cm t, avantage_cm a ";
  $reponse_req = $bdd->query($req);

include "../inc/menu.php";

?>
<main>
  <h1 class="text-center">Gestion de la page Membre</h1>

  <?php
    if($reponse_req->rowCount()>=1){
  ?>
     <table class="table-member">
      <thead>
         <tr>
          <th>Catégorie</th>
          <th>Prix Tarif</th>
          <th>Edit</th>
        </tr>
      </thead>
  <?php

    while ( $reponse_tableau = $reponse_req->fetch(PDO::FETCH_ASSOC)) {
  ?>
      <tbody>
        <tr>
          <td class="categorie_tarif_cm"><?php echo $reponse_tableau["categorie_tarif_cm"] ?></td>
          <td class="prix_tarif_cm"><?php echo $reponse_tableau["prix_tarif_cm"] ?></td>
          <td>
            <a href="member/edit_un.php?id=<?php echo $reponse_tableau["id_tarif_cm"] ?>">
              <i class='fas fa-edit'></i>
            </a>
          </td>
        </tr>
      </tbody>
  <table>

    <table class="table-member">
      <thead>
         <tr>
          <th>Avantage</th>
          <th>Edit</th>
        </tr>
      </thead>

      <tbody>
        <tr>
         <td class="description_avantage_cm"><?php echo $reponse_tableau["description_avantage_cm"] ?></td>
         <td>
            <a href="member/edit_deux.php?id=<?php echo $reponse_tableau["id_avantage_cm"] ?>">
              <i class='fas fa-edit'></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>

  <?php
    }
  ?>

</main>
<?php
}

include "../inc/footer.php";
?>

