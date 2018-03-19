<?php
require_once '../../inc/inc.php';

extract($_GET);

if(isset($id) && !empty($id)){
    $req_verif_event="SELECT *, date_format(date_debut, '%Y-%m-%d') AS date_d, date_format(date_fin, '%Y-%m-%d') AS date_f FROM evenement e, image i, date d, horaire h WHERE e.id_image= i.id_img AND e.id_date=d.id_date AND e.id_horaire=h.id_horaire AND e.id_event= :id";
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

// echo '<pre>';
//     print_r($_FILES);
// echo '</pre>';

extract($_POST);
extract($_FILES);

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($img_event) && isset($nom_event) && isset($description_event) && isset($lieu_event) && isset($date_deb_event) && isset($date_fin_event) && isset($heure_deb_event) && isset($heure_fin_event)){

        if(empty($nom_event) || empty($description_event) || empty($lieu_event) || empty($date_deb_event) || empty($date_fin_event) || empty($heure_deb_event) || empty($heure_fin_event)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }
        else{

            if(empty($img_event['name'])){

                $img_event_udp=$resultat_req_verif_event['url_img'];
                // echo $img_event_udp.'<br>';
                // echo $nom_event.'<br>';
                // echo $description_event.'<br>';
                // echo $lieu_event.'<br>';
                // echo $date_deb_event.'<br>';
                // echo $date_fin_event.'<br>';
                // echo $heure_deb_event.'<br>';
                // echo $heure_fin_event.'<br>';
                // echo $url_event.'<br>';

                $req_udp_event="
                UPDATE  
                    evenement e,
                    image i,
                    date d,
                    horaire h 
                SET 
                    i.url_img= :img_event_udp ,
                    i.date_creation_img= NOW() ,
                    d.date_debut= :date_deb_event ,
                    d.date_fin= :date_fin_event ,
                    e.nom_event= :nom_event_udp,
                    e.description_event= :description_event_udp,
                    e.lieu_event=:lieu_event_udp,
                    e.url_event= :url_event_udp,
                    h.heure_debut=:heure_debut_event_udp,
                    h.heure_fin=:heure_fin_event_udp
                    
                WHERE 
                    e.id_image=i.id_img 
                AND 
                    e.id_date=d.id_date 
                AND 
                    e.id_horaire=h.id_horaire 
                AND 
                    e.id_event= :id";

                $recherche_req_udp_event=$bdd->prepare($req_udp_event);
                $recherche_req_udp_event->bindParam(':id', $id, PDO::PARAM_INT);
                $recherche_req_udp_event->bindParam(':img_event_udp', $img_event_udp, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':nom_event_udp', $nom_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':description_event_udp', $description_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':lieu_event_udp', $lieu_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':date_deb_event', $date_deb_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':date_fin_event', $date_fin_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':heure_debut_event_udp', $heure_deb_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':heure_fin_event_udp', $heure_fin_event, PDO::PARAM_STR);
                $recherche_req_udp_event->bindParam(':url_event_udp', $url_event, PDO::PARAM_STR);
                $recherche_req_udp_event->execute();

                header('location:../event.php?udp=success1');


            }
            else{
                     //Verification si l'url de l'image existe deja dans la table image
                $req_unique_img="SELECT * FROM image WHERE url_img = :url_img";
                $recherche_req_unique_img=$bdd->prepare($req_unique_img);
                $recherche_req_unique_img->bindParam(':url_img', $img_event['name'], PDO::PARAM_STR);
                $recherche_req_unique_img->execute();

                //Si l'url existe deja alors afficher un message d'erreur
                if($recherche_req_unique_img->rowCount()>=1){
                    $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
                }
                else{

                    $name_img=$resultat_req_verif_event['url_img'];
                    unlink('../../upload_img/evenement/'.$name_img);

                    ////UPLOAD File
                    if(isset($_FILES["img_event"]["type"]))
                    {

                        $validextensions = array("jpeg", "jpg", "png");
                        $temporary = explode(".", $_FILES["img_event"]["name"]);
                        $file_extension = end($temporary);


                        if ((($_FILES["img_event"]["type"] == "image/png") || ($_FILES["img_event"]["type"] == "image/jpg") || ($_FILES["img_event"]["type"] == "image/jpeg")
                        ) && ($_FILES["img_event"]["size"] < 1048576) // taille max : 1Mo
                        && in_array($file_extension, $validextensions)) 
                        {


                            if ($_FILES["img_event"]["error"] > 0)
                            {
                            $msg= "Return Code: " . $_FILES["image"]["error"] . "<br/><br/>";
                            }
                            else
                            {

                                if (file_exists("../../upload_img/evenement/" . $_FILES["img_event"]["name"])) {

                                    $msg=$_FILES["img_event"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
                                }
                                else
                                {
                                    $sourcePath = $_FILES['img_event']['tmp_name']; // Storing source path of the file in a variable

                                    $targetPath = "../../upload_img/evenement/".$_FILES['img_event']['name']; // Target path where file is to be stored
                                    move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                                    
                                     $req_udp_event="
                                        UPDATE  
                                            evenement e,
                                            image i,
                                            date d,
                                            horaire h 
                                        SET 
                                            i.url_img= :img_event_udp ,
                                            i.date_creation_img= NOW() ,
                                            d.date_debut= :date_deb_event ,
                                            d.date_fin= :date_fin_event ,
                                            e.nom_event= :nom_event_udp,
                                            e.description_event= :description_event_udp,
                                            e.lieu_event=:lieu_event_udp,
                                            e.url_event= :url_event_udp,
                                            h.heure_debut=:heure_debut_event_udp,
                                            h.heure_fin=:heure_fin_event_udp
                                            
                                        WHERE 
                                            e.id_image=i.id_img 
                                        AND 
                                            e.id_date=d.id_date 
                                        AND 
                                            e.id_horaire=h.id_horaire 
                                        AND 
                                            e.id_event= :id";

                                        $recherche_req_udp_event=$bdd->prepare($req_udp_event);
                                        $recherche_req_udp_event->bindParam(':id', $id, PDO::PARAM_INT);
                                        $recherche_req_udp_event->bindParam(':img_event_udp', $img_event['name'], PDO::PARAM_STR);
                                        $recherche_req_udp_event->bindParam(':nom_event_udp', $nom_event, PDO::PARAM_STR);
                                        $recherche_req_udp_event->bindParam(':description_event_udp', $description_event, PDO::PARAM_STR);
                                        $recherche_req_udp_event->bindParam(':lieu_event_udp', $lieu_event, PDO::PARAM_STR);
                                        $recherche_req_udp_event->bindParam(':date_deb_event', $date_deb_event, PDO::PARAM_STR);
                                        $recherche_req_udp_event->bindParam(':date_fin_event', $date_fin_event, PDO::PARAM_STR);
                                        $recherche_req_udp_event->bindParam(':heure_debut_event_udp', $heure_deb_event, PDO::PARAM_STR);
                                        $recherche_req_udp_event->bindParam(':heure_fin_event_udp', $heure_fin_event, PDO::PARAM_STR);
                                        $recherche_req_udp_event->bindParam(':url_event_udp', $url_event, PDO::PARAM_STR);
                                        $recherche_req_udp_event->execute();

                                        header('location:../event.php?udp=success2');

                                }
                                
                            }
                        

                        }
                        else{
                            $msg='erreur sur l\'upload d\'image';
                        }

                    }   
                    ////////***********
                    
                }
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

    <form class="form-event" method="post" action="#" enctype="multipart/form-data">
        <label for="img_event">Image de l'evenement:</label>
        <div class="edit-img-bloc">
            <img src="../../upload_img/evenement/<?php echo htmlentities($resultat_req_verif_event['url_img']); ?>" alt="<?php echo htmlentities($resultat_req_verif_event['url_img']); ?>">
        </div>

        <input type="file" name="img_event">

        <label for="nom_event">Nom de l'événement:</label>
        <input type="text" name="nom_event" value="<?php echo htmlentities($resultat_req_verif_event['nom_event']);?>">

        <label for="description_event">Description de l'événement:</label>
        <textarea name="description_event" rows="10" cols="50" ><?php echo htmlentities($resultat_req_verif_event['description_event']);?></textarea>

        <label for="lieu_event">Lieu de l'événement</label>
        <input type="text" name="lieu_event" value="<?php echo htmlentities($resultat_req_verif_event['lieu_event']);?>">

        <label for="date_deb_event">Date du début de l'événement</label>
        <input type="date" name="date_deb_event" value="<?php echo htmlentities($resultat_req_verif_event['date_d']);?>">
   
    
        <label for="date_fin_event">Date de fin de l'événement</label>
        <input type="date" name="date_fin_event" value="<?php echo htmlentities($resultat_req_verif_event['date_f']);?>">

        <label for="heure_deb_event">Heure de début</label>
        <input name="heure_deb_event" type="time" value="<?php echo htmlentities($resultat_req_verif_event['heure_debut']) ?>">

        <label for="heure_fin_event">Heure de fin</label>
        <input name="heure_fin_event" type="time" value="<?php echo htmlentities($resultat_req_verif_event['heure_fin']) ?>">


        <label for="url_event">Site de l'évenement</label>
        <input type="text" name="url_event" value="<?php echo $resultat_req_verif_event['url_event'];?>">

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>









