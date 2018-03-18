<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_actu="SELECT * FROM actualite a, image i, date d WHERE a.id_image=i.id_img AND a.id_date = d.id_date AND id_actu= :id";
    $recherche_req_verif_actu=$bdd->prepare($req_verif_actu);
    $recherche_req_verif_actu->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_actu->execute();

    if($recherche_req_verif_actu->rowCount()==0){
        header('location:../actu.php?id=inconnu');
    }
    else{
        $resultat_req_verif_actu= $recherche_req_verif_actu->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../actu.php?id=nontrouve');
}


extract($_POST);


if(isset($non) && $non=="Non"){
	header('location:../actu.php?effacer=non');
}
elseif(isset($oui) && $oui=="Oui"){
	//on recherche l'id de l'image qui est associe a l'actualite pour la supprimer l'image
	$req_id_img="SELECT * FROM actualite a, image i WHERE a.id_image = i.id_img AND id_actu= :id";
	$recherche_req_id_img=$bdd->prepare($req_id_img);
	$recherche_req_id_img->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_id_img->execute();

    if($recherche_req_id_img->rowCount()!=1){
    	header('location:../actu.php?image_actu=introuvable');
    }
    else{
    	$resultat_image_actu=$recherche_req_id_img->fetch(PDO::FETCH_ASSOC);

    	$id_image_a_supprimer=$resultat_image_actu['id_image'];
        $url_image_a_supprimer=$resultat_image_actu['url_img'];

    }
    //supression de l'actu
	$req_delete_actu="DELETE FROM actualite WHERE id_actu= :id";
	$suppresion_req_delete_actu=$bdd->prepare($req_delete_actu);
	$suppresion_req_delete_actu->bindParam(':id', $id, PDO::PARAM_INT);
    $suppresion_req_delete_actu->execute();



    //suppression de l'image
    $req_delete_img_actu="DELETE FROM `image` WHERE id_img= :id_image_a_supprimer";
    $suppression_req_delete_img_actu=$bdd->prepare($req_delete_img_actu);
    $suppression_req_delete_img_actu->bindParam(':id_image_a_supprimer', $id_image_a_supprimer, PDO::PARAM_INT);
    $suppression_req_delete_img_actu->execute();

<<<<<<< HEAD
    unlink('../../upload_img/actualite/'.$url_image_a_supprimer);
=======
    unlink('../../upload_img/'.$url_image_a_supprimer);
>>>>>>> d4997d0ea2308f269eaa5acabbd994758923bfb1
    header('location:../actu.php?delete=success');
}



require_once "../../inc/menu_2.php";
?>
<main>

<h1 class="text-center">Gestion des actualités - Suppression -</h1>

<h3 class="text-center">Voulez-vous vraiment supprimer cette actualité?</h3>

<form class="form-actu" action="" method="post">

	<input class="btn-oui" type="submit" name="oui" value="Oui">
	<input class="btn-non" type="submit" name="non" value="Non">
       

</form>



</main>
<?php
include "../../inc/footer.php";
?>