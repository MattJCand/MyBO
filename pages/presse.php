<?php
require_once "../inc/menu.php";

  $req="SELECT * FROM presse p, image i WHERE p.id_image= i.id_img";
  $reponse_req = $bdd->query($req);
?>

<h1 class="align block_title">Index Page Presse</h1>
<a href="home.php"><i class="fas fa-home"></i></a>
<a href="presse/add.php"><i class="fas fa-plus-circle"></i></a>

<?php
  if($reponse_req->rowCount()>=1){
?>
   <table>
    <thead>
       <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Url</th>
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
      <td class="titre_presse"><?php echo $reponse_tableau["titre_presse"] ?></td>
      <td class="description_prof"><?php echo $reponse_tableau["description_presse"] ?></td>
      <td class="url_presse"><?php echo $reponse_tableau["url_presse"] ?></td>
      <td>
        <a href="press/edit.php?id=<?php echo $reponse_tableau["id_presse"] ?>">
          <i class='fas fa-edit'></i>
        </a>
      </td>
      <td>
          <a href="press/delete.php?id=<?php echo $reponse_tableau["id_presse"]?>" onClick=" confirm('Are you sure you want to delete?')">
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

