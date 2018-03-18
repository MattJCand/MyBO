<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_actu="SELECT * FROM galerie WHERE  id_galerie= :id";
    $recherche_req_verif_galerie=$bdd->prepare($req_verif_galerie);
    $recherche_req_verif_galerie->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_galerie->execute();

    if($recherche_req_verif_galerie->rowCount()==0){
        header('location:../galerie.php?id=inconnu');
    }
    else{
        $resultat_req_verif_galerie= $recherche_req_verif_galerie->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../galerie.php?id=nontrouve');
}


extract($_POST);


if(isset($non) && $non=="Non"){
  header('location:../galerie.php?effacer=non');
}
elseif(isset($oui) && $oui=="Oui"){
    //supression de l'actu
  $req_delete_galerie="DELETE FROM galerie WHERE id_galerie= :id";
  $suppresion_req_delete_galerie=$bdd->prepare($req_delete_galerie);
  $suppresion_req_delete_galerie->bindParam(':id', $id, PDO::PARAM_INT);
  $suppresion_req_delete_galerie->execute();

    header('location:../galerie.php?delete=success');
}



require_once "../../inc/menu_2.php";
?>
<main>

<h1 class="text-center">Gestion de la galerie - Suppression -</h1>

<h3 class="text-center">Voulez-vous vraiment supprimer cette image ?</h3>

<form class="form-actu" action="" method="post">

  <input class="btn-oui" type="submit" name="oui" value="Oui">
  <input class="btn-non" type="submit" name="non" value="Non">


</form>



</main>
<?php
include "../../inc/footer.php";
?>
