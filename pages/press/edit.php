<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_presse="SELECT * FROM presse p, image i WHERE p.id_image=i.id_img AND id_presse= :id";
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

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($img_presse) && isset($titre_presse) && isset($description_presse)){

        if(empty($img_presse) || empty($titre_presse) || empty($description_presse)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }
        else{
            //Verification si l'url de l'image existe deja dans la table image
            $req_unique_img="SELECT * FROM image WHERE url_img = :url_img";
            $recherche_req_unique_img=$bdd->prepare($req_unique_img);
            $recherche_req_unique_img->bindParam(':url_img', $img_actu, PDO::PARAM_STR);
            $recherche_req_unique_img->execute();

            //Si l'url existe deja alors afficher un message d'erreur
            if($recherche_req_unique_img->rowCount()>=1){
                $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
            }
            else{

                $req_udp_actu="UPDATE presse p, image i SET i.url_img= :img_presse_udp , i.date_creation_img= NOW() , p.titre_presse= :titre_presse_udp, p.description_presse= :description_presse_udp, p.url_presse= :url_presse_udp  WHERE p.id_image=i.id_img  AND p.id_presse= :id";
                $recherche_req_udp_presse=$bdd->prepare($req_udp_actu);
                $recherche_req_udp_presse->bindParam(':id', $id, PDO::PARAM_INT);
                $recherche_req_udp_presse->bindParam(':img_presse_udp', $img_presse, PDO::PARAM_STR);
                $recherche_req_udp_presse->bindParam(':titre_presse_udp', $titre_presse, PDO::PARAM_STR);
                $recherche_req_udp_presse->bindParam(':description_presse_udp', $description_presse, PDO::PARAM_STR);
                $recherche_req_udp_presse->bindParam(':url_presse_udp', $url_presse, PDO::PARAM_STR);
                $recherche_req_udp_presse->execute();

                header('location:../presse.php?udp=success');

            }

        }
    }
    else{
        $msg="Erreur sur le champs";
    }
}

require_once "../../inc/menu_2.php";

?>
<main>
    <h1 class="text-center">Gestion Presse - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-actu" method="post" action="#">
        <label for="img_actu">Image de l'article Presse :</label>
        <div class="edit-img-bloc">
            <img src="<?php echo $resultat_req_verif_presse['url_img']; ?>" alt="<?php echo $resultat_req_verif_presse['url_img']; ?>">
        </div>

        <input type="file" name="img_presse">

        <label for="titre_presse">Titre Presse:</label>
        <input type="text" name="titre_presse" value="<?php echo $resultat_req_verif_presse['titre_presse'];?>">

        <label for="description_presse">Description article de presse:</label>
        <textarea name="description_presse" rows="10" cols="50" ><?php echo $resultat_req_verif_presse['description_presse'];?></textarea>

        <label for="url_presse">Url de l'article de presse</label>
        <input type="text" name="url_presse" value="<?php echo $resultat_req_verif_presse['url_presse'];?>">

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>
