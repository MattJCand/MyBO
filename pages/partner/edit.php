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

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($img_actu) && isset($titre_actu) && isset($description_actu)){

        if(empty($img_actu) || empty($titre_actu) || empty($description_actu)){
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

                $req_udp_actu="UPDATE actualite a, image i, date d SET i.url_img= :img_actu_udp , i.date_creation_img= NOW() , d.date_debut= NOW() , a.titre_actu= :titre_actu_udp, a.description_actu= :description_actu_udp, a.url_actu= :url_actu_udp  WHERE a.id_image=i.id_img AND a.id_date=d.id_date AND a.id_actu= :id";
                $recherche_req_udp_actu=$bdd->prepare($req_udp_actu);
                $recherche_req_udp_actu->bindParam(':id', $id, PDO::PARAM_INT);
                $recherche_req_udp_actu->bindParam(':img_actu_udp', $img_actu, PDO::PARAM_STR);
                $recherche_req_udp_actu->bindParam(':titre_actu_udp', $titre_actu, PDO::PARAM_STR);
                $recherche_req_udp_actu->bindParam(':description_actu_udp', $description_actu, PDO::PARAM_STR);
                $recherche_req_udp_actu->bindParam(':url_actu_udp', $url_actu, PDO::PARAM_STR);
                $recherche_req_udp_actu->execute();

                header('location:../actu.php?udp=success');

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
    <h1 class="text-center">Gestion des partenaire - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-actu" method="post" action="#">
        <label for="image">Image de l'actu :</label>
        <div class="edit-actu-img-bloc">  
        <img src="<?php echo $resultat_req_verif_actu['url_img']; ?>" alt="<?php echo $resultat_req_verif_actu['url_img']; ?>">
        </div> 
        
        <input type="file" name="image">

        <label for="titre">Titre de l'actualité:</label>
        <input type="text" name="titre" value="<?php echo $resultat_req_verif_actu['titre_actu'];?>">

        <label for="description">Description de l'actualité:</label>
        <textarea name="description" rows="10" cols="50" ><?php echo $resultat_req_verif_actu['description_actu'];?></textarea>

        <label for="adresse">Titre de l'actualité:</label>
        <input type="text" name="adresse" value="<?php echo $resultat_req_verif_actu['titre_actu'];?>">

        <label for="url"></label>
        <input type="text" name="url" value="<?php echo $resultat_req_verif_actu['url_actu'];?>">

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>