<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_event="SELECT *, date_format(date_debut, '%Y-%m-%d') AS date_d, date_format(date_fin, '%Y-%m-%d') AS date_f FROM evenement e, image i, date d, horaire h WHERE e.id_image= i.id_img AND e.id_date=d.id_date AND e.id_horaire=h.id_horaire AND e.id_event= :id";
    $recherche_req_verif_event=$bdd->prepare($req_verif_event);
    $recherche_req_verif_event->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_event->execute();

    if($recherche_req_verif_event->rowCount()==0){
        header('location:../event.php?id=inconnu');
    }
    else{
        $resultat_req_verif_event= $recherche_req_verif_event->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../event.php?id=nontrouve');
}


extract($_POST);


if(isset($non) && $non=="Non"){
  header('location:../event.php?effacer=non');
}
elseif(isset($oui) && $oui=="Oui"){
  //on recherche l'id de l'image qui est associe a l'actualite pour la supprimer l'image
  $req_id_img="SELECT *, date_format(date_debut, '%Y-%m-%d') AS date_d, date_format(date_fin, '%Y-%m-%d') AS date_f FROM evenement e, image i, date d, horaire h WHERE e.id_image= i.id_img AND e.id_date=d.id_date AND e.id_horaire=h.id_horaire AND e.id_event= :id";
  $recherche_req_id_img=$bdd->prepare($req_id_img);
  $recherche_req_id_img->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_id_img->execute();

    if($recherche_req_id_img->rowCount()!=1){
      header('location:../event.php?image_event=introuvable');
    }
    else{
      $resultat_image_event=$recherche_req_id_img->fetch(PDO::FETCH_ASSOC);

      $id_image_a_supprimer=$resultat_image_event['id_image'];
      $url_image_a_supprimer=$resultat_image_event['url_image'];

    }
    //supression de l'event
    $req_delete_event="DELETE FROM evenement WHERE id_event= :id";
    $suppresion_req_delete_event=$bdd->prepare($req_delete_event);
    $suppresion_req_delete_event->bindParam(':id', $id, PDO::PARAM_INT);
    $suppresion_req_delete_event->execute();

    //suppression de l'image
    $req_delete_img_event="DELETE FROM `image` WHERE id_img= :id_image_a_supprimer";
    $suppression_req_delete_img_event=$bdd->prepare($req_delete_img_event);
    $suppression_req_delete_img_event->bindParam(':id_image_a_supprimer', $id_image_a_supprimer, PDO::PARAM_INT);
    $suppression_req_delete_img_event->execute();

    

    unlink('../../upload_img/evenement/'.$url_image_a_supprimer);
    header('location:../event.php?delete=success');
}



require_once "../../inc/menu_2.php";
?>
<main>

<h1 class="text-center">Gestion des événements - Suppression -</h1>

<h3 class="text-center">Voulez-vous vraiment supprimer cet événement?</h3>

<form class="form-event" action="" method="post">

  <input class="btn-oui" type="submit" name="oui" value="Oui">
  <input class="btn-non" type="submit" name="non" value="Non">


</form>



</main>
<?php
include "../../inc/footer.php";
?>
