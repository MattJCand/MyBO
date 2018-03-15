<?php
require_once '../../inc/inc.php';

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


require_once "../../inc/menu_2.php";


?>

	

<?php
include "../../inc/footer.php";

 ?>