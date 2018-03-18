<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($categorie) && !empty($tarif)){
    $req_verif_member="SELECT *  FROM tarif_cm  WHERE  id_tarif_cm= :id";
    $recherche_req_verif_member=$bdd->prepare($req_verif_member);
    $recherche_req_verif_member->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_member->execute();

    if($recherche_req_verif_member->rowCount()==0){
        header('location:../member.php?id=inconnu');
    }
    else{
        $resultat_req_verif_member= $recherche_req_verif_member->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../member.php?id=nontrouve');
}


extract($_POST);

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($categorie) && isset($tarif)){

        if(empty($categorie) || empty($tarif)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }

        else{

        $req_udp_member="UPDATE tarif_cm tcm SET tcm.categorie_tarif_cm= :categorie, tcm.prix_tarif_cm=:prix  WHERE tcm.id_tarif_cm= :id";
        $recherche_req_udp_member=$bdd->prepare($req_udp_member);
        $recherche_req_udp_member->bindParam(':id', $id, PDO::PARAM_INT);
        $recherche_req_udp_member->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $recherche_req_udp_member->bindParam(':prix', $prix, PDO::PARAM_STR);
        $recherche_req_udp_member->execute();

        header('location:../team.php?udp=success');

            }

        }
    }
    else{
        $msg="Erreur sur le champs";
}


require_once "../../inc/menu_2.php";

?>
<main>
    <h1 class="text-center">Gestion des avantages membre - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-membre" method="post" action="#">

        <label for="categorie">Catégorie:</label>
        <input type="text" name="categorie" value="<?php echo $resultat_req_verif_member['categorie'];?>">


        <label for="prix">Prix Membre:</label>
        <input type="text" name="prix" value="<?php echo $resultat_req_verif_member['prix'];?>">

        <div class="btn-form-bloc">
            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">
        </div>
    </form>
</main>


<?php
include "../../inc/footer.php";

 ?>
