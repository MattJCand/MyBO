<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_presse="SELECT *  FROM presse p, image i WHERE p.id_image= i.id_img AND id_presse= :id";
    $recherche_req_verif_presse=$bdd->prepare($req_verif_presse);
    $recherche_req_verif_presse->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_presse->execute();

    if($recherche_req_verif_presse->rowCount()==0){
        header('location:../presse.php?id=inconnu');
    }
    else{
        $resultat_req_verif_presse= $recherche_req_verif_presse->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../presse.php?id=nontrouve');
}


extract($_POST);


if(isset($non) && $non=="Non"){
  header('location:../presse.php?effacer=non');
}
elseif(isset($oui) && $oui=="Oui"){
  //on recherche l'id de l'image qui est associe a l'article de presse pour la supprimer l'image
  $req_id_img="SELECT *  FROM presse p, image i WHERE p.id_image= i.id_img id_presse= :id";
  $recherche_req_id_img=$bdd->prepare($req_id_img);
  $recherche_req_id_img->bindParam(':id', $id, PDO::PARAM_INT);
  $recherche_req_id_img->execute();

    if($recherche_req_id_img->rowCount()!=1){
      header('location:../presse.php?image_presse=introuvable');
    }
    else{
      $resultat_image_presse=$recherche_req_id_img->fetch(PDO::FETCH_ASSOC);

      $id_image_a_supprimer=$resultat_image_presse['id_image'];

    }
    //supression de l'article de presse
  $req_delete_presse="DELETE FROM presse WHERE id_presse= :id";
  $suppresion_req_delete_presse=$bdd->prepare($req_delete_presse);
  $suppresion_req_delete_presse->bindParam(':id', $id, PDO::PARAM_INT);
  $suppresion_req_delete_presse->execute();



    //suppression de l'image
    $req_delete_img_presse="DELETE FROM `image` WHERE id_img= :id_image_a_supprimer";
    $suppression_req_delete_img_presse=$bdd->prepare($req_delete_img_presse);
    $suppression_req_delete_img_presse->bindParam(':id_image_a_supprimer', $id_image_a_supprimer, PDO::PARAM_INT);
    $suppression_req_delete_img_presse->execute();

    header('location:../presse.php?delete=success');
}



require_once "../../inc/menu_2.php";
?>
<main>

<h1 class="text-center">Gestion des articles de presse - Suppression -</h1>

<h3 class="text-center">Voulez-vous vraiment supprimer cette article de presse?</h3>

<form class="form-presse" action="" method="post">

  <input class="btn-oui" type="submit" name="oui" value="Oui">
  <input class="btn-non" type="submit" name="non" value="Non">


</form>



</main>
<?php
include "../../inc/footer.php";
?>
