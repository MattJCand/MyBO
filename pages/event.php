<?php
require_once "../inc/menu.php";

  $req="SELECT *, date_format(date_debut, '%d/%m/%Y') AS date_fr FROM evenement e, image i, date d, horaire h WHERE e.id_image= i.id_img AND e.id_date=d.id_date AND e.id_horaire=h.id_horaire";
  $reponse_req = $bdd->query($req);
?>

<h1 class="align block_title">Index Page Evenement</h1>
<a href="home.php"><i class="fas fa-home"></i></a>
<a href="event/add.php"><i class="fas fa-plus-circle"></i></a>

<?php
  if($reponse_req->rowCount()>=1){
?>
   <table>
    <thead>
       <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Lieu</th>
        <th>Url</th>
       <!--  <th>Date Début</th>
        <th>Date fin</th>
        <th>Heure début</th>
        <th>Heure fin</th> -->
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
      <td class="nom_event"><?php echo $reponse_tableau["nom_event"] ?></td>
      <td class="description_event"><?php echo $reponse_tableau["description_event"] ?></td>
      <td class="lieu_event"><?php echo $reponse_tableau["lieu_event"] ?></td>
      <td class="url_presse"><?php echo $reponse_tableau["url_event"] ?></td>
      <td>
        <a href="event/edit.php?id=<?php echo $reponse_tableau["id_event"] ?>">
          <i class='fas fa-edit'></i>
        </a>
      </td>
      <td>
        <a href="event/delete.php?id=<?php echo $reponse_tableau["id_event"]?>" onClick=" confirm('Are you sure you want to delete?')">
          <i class='fas fa-trash'></i>
        </a>
      </td>
    </tr>

<?php
  }
?>
  </tbody>
<table>

<?php
}
?>


