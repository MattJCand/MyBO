<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_cours="SELECT * FROM cours";
    $recherche_req_verif_cours=$bdd->prepare($req_verif_cours);
    $recherche_req_verif_cours->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_cours->execute();

    if($recherche_req_verif_cours->rowCount()==0){
        header('location:../cours.php?id=inconnu');
    }
    else{
        $resultat_req_verif_cours= $recherche_req_verif_cours->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../cours.php?id=nontrouve');
}


extract($_POST);

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($intitule_cours) && isset($description_cours)){

        if(empty($intitule_cours) || empty($description_cours)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }
        else{
                $req_udp_cours="UPDATE ";
                $recherche_req_udp_cours=$bdd->prepare($req_udp_cours);
                $recherche_req_udp_cours->bindParam(':id', $id, PDO::PARAM_INT);
                $recherche_req_udp_cours->bindParam(':intitule_cours_udp', $titre_cours, PDO::PARAM_STR);
                $recherche_req_udp_cours->bindParam(':description_cours_udp', $description_cours, PDO::PARAM_STR);
                $recherche_req_udp_cours->execute();

                header('location:../cours.php?udp=success');
            }
    }
    else{
        $msg="Erreur sur le champs";
    }
}

require_once "../../inc/menu_2.php";

?>
<main>
    <h1 class="text-center">Gestion des cours - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-cours" method="post" action="#">

        <label for="intitule_cours">Intitule du cours:</label>
        <input type="text" name="intitule_cours" value="<?php echo $resultat_req_verif_cours['intitule_cours'];?>">

        <label for="description_cours">Description du cours:</label>
        <textarea name="description_cours" rows="10" cols="50" ><?php echo $resultat_req_verif_cours['description_cours'];?></textarea>

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>
