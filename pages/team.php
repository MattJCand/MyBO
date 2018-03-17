<?php
require_once '../inc/inc.php';

require_once "../inc/menu.php";

  $req="SELECT * FROM professeur p, image i WHERE p.id_image= i.id_img";
  $reponse_req = $bdd->query($req);
?>

<h1 class="align block_title">Index Page Equipe</h1>
<a href="home.php"><i class="fas fa-home"></i></a>
<a href="team/add.php"><i class="fas fa-plus-circle"></i></a>

<?php
  if($reponse_req->rowCount()>=1){
?>
   <table>
    <thead>
       <tr>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Profession</th>
        <th>Description</th>
        <th>Email</th>
        <th>Tarif Cours</th>
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
      <td class="prenom_prof"><?php echo $reponse_tableau["prenom_prof"] ?></td>
      <td class="nom_prof"><?php echo $reponse_tableau["nom_prof"] ?></td>
      <td class="profession_prof"><?php echo $reponse_tableau["profession_prof"] ?></td>
      <td class="description_prof"><?php echo $reponse_tableau["description_prof"] ?></td>
      <td class="email_prof"><?php echo $reponse_tableau["email_prof"] ?></td>
      <td class="tarif_prof"><?php echo $reponse_tableau["tarif_prof"] ?></td>
      <td>
        <a href="team/edit.php?id=<?php echo $reponse_tableau["id_prof"] ?>">
          <i class='fas fa-edit'></i>
        </a>
      </td>
      <td>
        <a href="team/delete.php?id=<?php echo $reponse_tableau["id_prof"]?>">
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
