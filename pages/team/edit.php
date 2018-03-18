<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_prof="SELECT * FROM professeur p, image i WHERE p.id_image= i.id_img AND id_prof= :id";
    $recherche_req_verif_prof=$bdd->prepare($req_verif_prof);
    $recherche_req_verif_prof->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_prof->execute();

    if($recherche_req_verif_prof->rowCount()==0){
        header('location:../team.php?id=inconnu');
    }
    else{
        $resultat_req_verif_prof= $recherche_req_verif_prof->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../team.php?id=nontrouve');
}


extract($_POST);

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($img_prof) && isset($nom_prof) && isset($description_prof)){

        if(empty($img_prof) || empty($nom_prof) || empty($description_prof)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }
        else{
            //Verification si l'url de l'image existe deja dans la table image
            $req_unique_img="SELECT * FROM image WHERE url_img = :url_img";
            $recherche_req_unique_img=$bdd->prepare($req_unique_img);
            $recherche_req_unique_img->bindParam(':url_img', $img_prof, PDO::PARAM_STR);
            $recherche_req_unique_img->execute();

            //Si l'url existe deja alors afficher un message d'erreur
            if($recherche_req_unique_img->rowCount()>=1){
                $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
            }
            else{

                $req_udp_prof="UPDATE professeur p, image i SET i.url_img= :img_prof_udp , i.date_creation_img= NOW(), p.nom_prof= :nom_prof_udp, p.prenom_prof=:prenom_prof_udp, p.description_prof= :description_prof_udp, p.email_prof=:email_prof_udp, p.profession_prof=:profession_prof_udp  WHERE p.id_image=i.id_img AND p.id_prof= :id";
                $recherche_req_udp_prof=$bdd->prepare($req_udp_prof);
                $recherche_req_udp_prof->bindParam(':id', $id, PDO::PARAM_INT);
                $recherche_req_udp_prof->bindParam(':img_prof_udp', $img_prof, PDO::PARAM_STR);
                $recherche_req_udp_prof->bindParam(':nom_prof_udp', $nom_prof, PDO::PARAM_STR);
                $recherche_req_udp_prof->bindParam(':prenom_prof_udp', $prenom_prof, PDO::PARAM_STR);
                $recherche_req_udp_prof->bindParam(':description_prof_udp', $description_prof, PDO::PARAM_STR);
                $recherche_req_udp_prof->bindParam(':email_prof_udp', $email_prof, PDO::PARAM_STR);
                $recherche_req_udp_prof->bindParam(':profession_prof_udp', $profession_prof, PDO::PARAM_STR);
                $recherche_req_udp_prof->execute();

                header('location:../team.php?udp=success');

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
    <h1 class="text-center">Gestion des professeurs - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-prof" method="post" action="#">
        <label for="img_prof">Image Profil Professeur :</label>
        <div class="edit-img-bloc">
            <img src="<?php echo $resultat_req_verif_prof['url_img']; ?>" alt="<?php echo $resultat_req_verif_prof['url_img']; ?>">
        </div>

        <input type="file" name="img_prof">

        <label for="nom_prof">Nom du Professeur:</label>
        <input type="text" name="nom_prof" value="<?php echo $resultat_req_verif_prof['nom_prof'];?>">


        <label for="prenom_prof">Prenom du Professeur:</label>
        <input type="text" name="prenom_prof" value="<?php echo $resultat_req_verif_prof['prenom_prof'];?>">


        <label for="description_prof">Description du Professeur:</label>
        <textarea name="description_prof" rows="10" cols="50" ><?php echo $resultat_req_verif_prof['description_prof'];?></textarea>

        <label for="prenom_prof">Email du Professeur:</label>
        <input type="text" name="email_prof" value="<?php echo $resultat_req_verif_prof['email_prof'];?>">

        <label for="profession_prof">Profession du Professeur:</label>
        <input type="text" name="profession_prof" value="<?php echo $resultat_req_verif_prof['profession_prof'];?>">

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>


