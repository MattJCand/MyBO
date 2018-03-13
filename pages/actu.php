<?php
require_once "../inc/menu.php";

  $req="SELECT *, date_format(date_debut, '%d/%m/%Y') AS date_fr FROM actualite a, image i, date d WHERE a.id_image= i.id_img AND a.id_date=d.id_date";
  $reponse_req = $bdd->query($req);
?>

<h1 class="align block_title">Index Page Actualité</h1>
<a href="../home.php"><i class="fas fa-home"></i></a>
<a href="actu/add.php"><i class="fas fa-plus-circle"></i></a>




<?php
  if($reponse_req->rowCount()>=1){
?>
   <table>
    <thead>
       <tr>
        <th>Image</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Url</th>
        <th>Date</th>
        <th colspan=2>Gestion</th>
        
      </tr>
    </thead> 
<?php 

  while ( $reponse_tableau = $reponse_req->fetch(PDO::FETCH_ASSOC)) {
?>
    <tbody>
      <tr>
      <td class="img_actu"><?php echo $reponse_tableau["url_img"] ?></td>
      <td class="titre_actu"><?php echo $reponse_tableau["titre_actu"] ?></td>
      <td class="description_actu"><?php echo $reponse_tableau["description_actu"] ?></td>
      <td class="url_actu"><a href="http://<?php echo $reponse_tableau["url_actu"] ?>"><?php echo $reponse_tableau["url_actu"] ?></a></td>
      <td class="date_actu"><?php echo $reponse_tableau["date_fr"] ?></td>
      <td>
        <a href="actu/edit.php?id=<?php echo $reponse_tableau["id_actu"] ?>">
          <i class='fas fa-edit'></i>
        </a>
      </td>
      <td>
        <a href="actu/delete.php?id=$reponse_tableau[id]" onClick=" confirm('Are you sure you want to delete?')">
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

