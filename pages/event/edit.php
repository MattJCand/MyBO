<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_event="SELECT *, date_format(date_debut, '%d/%m/%Y') AS date_fr FROM evenement e, image i, date d, horaire h WHERE e.id_image= i.id_img AND e.id_date=d.id_date AND e.id_horaire=h.id_horaire";
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

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($img_event) && isset($nom_event) && isset($description_event)){

        if(empty($img_event) || empty($nom_event) || empty($description_event)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }
        else{
            //Verification si l'url de l'image existe deja dans la table image
            $req_unique_img="SELECT * FROM image WHERE url_img = :url_img";
            $recherche_req_unique_img=$bdd->prepare($req_unique_img);
            $recherche_req_unique_img->bindParam(':url_img', $img_event, PDO::PARAM_STR);
            $recherche_req_unique_img->execute();

            //Si l'url existe deja alors afficher un message d'erreur
            if($recherche_req_unique_img->rowCount()>=1){
                $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
            }
            else{

                $req_udp_event="UPDATE event e, image i, date d, horaire h SET i.url_img= :img_event_udp , i.date_creation_img= NOW() , d.date_debut= NOW() , e.nom_event= :nom_event_udp, e.description_event= :description_event_udp, e.url_event= :url_event_udp, e.lieu_event=:lieu_event_udp, h.heure_debut=:heure_debut_event_udp  WHERE e.id_image=i.id_img AND e.id_date=d.id_date AND e.id_horaire=h.id_horaire AND e.id_event= :id";
                $recherche_req_udp_event=$bdd->prepare($req_udp_event);
                $recherche_req_udp_event->bindParam(':id', $id, PDO::PARAM_INT);
                $recherche_req_udp_event->bindParam(':img_event_udp', $img_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':nom_event_udp', $nom_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':description_event_udp', $description_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':url_event_udp', $url_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':lieu_event_udp', $lieu_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':heure_debut_event_udp', $heure_debut_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':heure_fin_event_udp', $heure_fin_event, PDO::PARAM_STR);
                $recherche_req_udp_event->execute();

                header('location:../event.php?udp=success');

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
    <h1 class="text-center">Gestion des evenements - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-event" method="post" action="#">
        <label for="img_event">Image de l'evenements :</label>
        <div class="edit-img-bloc">
            <img src="<?php echo $resultat_req_verif_event['url_img']; ?>" alt="<?php echo $resultat_req_verif_event['url_img']; ?>">
        </div>

        <input type="file" name="img_event">

        <label for="nom_event">Nom de l'événement:</label>
        <input type="text" name="nom_event" value="<?php echo $resultat_req_verif_event['nom_event'];?>">

        <label for="description_event">Description de l'événement:</label>
        <textarea name="description_event" rows="10" cols="50" ><?php echo $resultat_req_verif_event['description_event'];?></textarea>

        <label for="url_event">Site de l'évenement</label>
        <input type="text" name="url_event" value="<?php echo $resultat_req_verif_event['url_event'];?>">

        <label for="lieu_event">Lieu de l'événement</label>
        <input type="text" name="lieu_event" value="<?php echo $resultat_req_verif_event['lieu_event'];?>">

        <label for="lieu_event">Date de l'événement</label>
        <input type="text" name="date_event" value="<?php echo $resultat_req_verif_event['date_fr'];?>">

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>









