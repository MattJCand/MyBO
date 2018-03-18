<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_professeur="SELECT * FROM professeur p, image i WHERE p.id_image= i.id_img AND id_prof= :id";
    $recherche_req_verif_professeur=$bdd->prepare($req_verif_professeur);
    $recherche_req_verif_professeur->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_professeur->execute();

    if($recherche_req_verif_professeur->rowCount()==0){
        header('location:../team.php?id=inconnu');
    }
    else{
        $resultat_req_verif_professeur= $recherche_req_verif_professeur->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../team.php?id=nontrouve');
}


extract($_POST);


if(isset($non) && $non=="Non"){
  header('location:../team.php?effacer=non');
}
elseif(isset($oui) && $oui=="Oui"){
  //on recherche l'id de l'image qui est associe a l'article de presse pour la supprimer l'image
  $req_id_img="SELECT *  FROM professeur p, image i WHERE p.id_image= i.id_img id_prof= :id";
  $recherche_req_id_img=$bdd->prepare($req_id_img);
  $recherche_req_id_img->bindParam(':id', $id, PDO::PARAM_INT);
  $recherche_req_id_img->execute();

    if($recherche_req_id_img->rowCount()!=1){
      header('location:../team.php?image_professeur=introuvable');
    }
    else{
      $resultat_image_presse=$recherche_req_id_img->fetch(PDO::FETCH_ASSOC);

      $id_image_a_supprimer=$resultat_image_presse['id_image'];

    }
    //supression de l'article de presse
  $req_delete_professeur="DELETE FROM professeur WHERE id_prof= :id";
  $suppresion_req_delete_professeur=$bdd->prepare($req_delete_professeur);
  $suppresion_req_delete_professeur->bindParam(':id', $id, PDO::PARAM_INT);
  $suppresion_req_delete_professeur->execute();



    //suppression de l'image
    $req_delete_img_professeur="DELETE FROM `image` WHERE id_img= :id_image_a_supprimer";
    $suppression_req_delete_img_professeur=$bdd->prepare($req_delete_img_professeur);
    $suppression_req_delete_img_professeur->bindParam(':id_image_a_supprimer', $id_image_a_supprimer, PDO::PARAM_INT);
    $suppression_req_delete_img_professeur->execute();

    header('location:../team.php?delete=success');
}



require_once "../../inc/menu_2.php";
?>
<main>

<h1 class="text-center">Gestion des professeurs - Suppression -</h1>

<h3 class="text-center">Voulez-vous vraiment supprimer se professeur?</h3>

<form class="form-team" action="" method="post">

  <input class="btn-oui" type="submit" name="oui" value="Oui">
  <input class="btn-non" type="submit" name="non" value="Non">


</form>



</main>
<?php
include "../../inc/footer.php";
?>
