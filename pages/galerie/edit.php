<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_galerie="SELECT * FROM galerie WHERE id_galerie= :id";
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

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($img_galerie) && isset($nom)){

        if(empty($img_galerie) || empty($nom)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }
        else{

            $req_udp_="UPDATE galerie g WHERE g.id_galerie= :id";
            $recherche_req_udp_galerie=$bdd->prepare($req_udp_galerie);
            $recherche_req_udp_galerie->bindParam(':id', $id, PDO::PARAM_INT);
            $recherche_req_udp_galerie->bindParam(':nom_img_udp', $nom_img, PDO::PARAM_STR);
            $recherche_req_udp_galerie->bindParam(':url_img', $img_galerie, PDO::PARAM_STR);
            $recherche_req_udp_galerie->bindParam(':display_img_udp', $display_img, PDO::PARAM_BOOL);
            $recherche_req_udp_galerie->execute();

            header('location:../galerie.php?udp=success');

            }

        }
    }
    else{
        $msg="Erreur sur le champs";
    }
require_once "../../inc/menu_2.php";

?>
<main>
    <h1 class="text-center">Gestion de la galerie - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-galerie" method="post" action="#">
        <label for="img_galerie">Image de la galerie :</label>
        <div class="edit-img-bloc">
            <img src="<?php echo $resultat_req_verif_galerie['url_img']; ?>" alt="<?php echo $resultat_req_verif_galerie['url_img']; ?>">
        </div>

        <input type="file" name="img_galerie">

        <label for="nom_img_">Nom de l'image:</label>
        <input type="text" name="nom_img" value="<?php echo $resultat_req_verif_galerie['nom_img'];?>">

        <label for="display_img">Affichage de l'image:</label>
        <input type="checkbox" name="display_img" value="<?php echo $resultat_req_verif_galerie['display_img'];?>">

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>
