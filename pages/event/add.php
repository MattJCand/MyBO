<?php
require_once '../../inc/inc.php';


extract($_POST);

if(isset($enregistrer) && $enregistrer=="Enregistrer"){

  if(isset($image) && isset($nom) && isset($description)){
    if(empty($image)  || empty($nom) || empty($description))
    {
      $msg="Veuillez remplir tous les champs obligatoire s'il vous plaît";
    }
    else
    {
      //Verification si l'url de l'image existe deja dans la table image
      $req_unique_img="SELECT * FROM image WHERE url_img = :url_img";
      $recherche_req_unique_img=$bdd->prepare($req_unique_img);
      $recherche_req_unique_img->bindParam(':url_img', $image, PDO::PARAM_STR);
      $recherche_req_unique_img->execute();

      //Si l'url existe deja alors afficher un message d'erreur
      if($recherche_req_unique_img->rowCount()>=1){
        $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
      }
      else{
        //Enregistrement de l'image dans la bdd
        $req_insert_img_event="INSERT INTO `image`(`url_img`, `date_creation_img`) VALUES (:url_img , NOW())";
        $insertion_img_event=$bdd->prepare($req_insert_img_event);
        $insertion_img_event->bindParam(':url_img', $image, PDO::PARAM_STR);
        $insertion_img_event->execute();

        // echo 'img_enregistrée<br>';

        $recherche_req_unique_img->execute();

        if($insertion_img_event->rowCount()==1){

          $recuperation_url_img = $recherche_req_unique_img->fetch(PDO::FETCH_ASSOC);

          //stock l'id de l'image pour l'enregistrer dans l'event qui va être créé
          $id_img_event=$recuperation_url_img['id_img'];//***********
          // echo $id_img_event;

          $date_now=date("Y-m-d");

          //Verification si la date existe deja dans la table date
          $req_unique_date="SELECT * FROM date WHERE date_debut = :date_now ";
          $recherche_req_unique_date=$bdd->prepare($req_unique_date);
          $recherche_req_unique_date->bindParam(':date_now', $date_now, PDO::PARAM_STR);
          $recherche_req_unique_date->execute();

          if($recherche_req_unique_date->rowCount()>=1){
            // echo "date existante";
          }
          else{
            $req_insert_date="INSERT INTO `date`(`date_debut`, `date_fin`) VALUES ( :date_debut, :date_fin)";
            $insertion_date=$bdd->exec($req_insert_date);
            // echo "nouvelle date";
            //on relance une recherche
            $recherche_req_unique_date->execute();

          }

          //Verification si l'heure existe deja dans la table date
          $req_unique_time="SELECT * FROM horaire WHERE heure_debut = :heure_debut AND heure_fin = :heure_fin";
          $recherche_req_unique_time=$bdd->prepare($req_unique_time);
          $recherche_req_unique_time->bindParam(':heure_debut', $heure_debut, PDO::PARAM_STR);
          $recherche_req_unique_time->bindParam(':heure_fin', $heure_fin, PDO::PARAM_STR);
          $recherche_req_unique_time->execute();

          if($recherche_req_unique_time->rowCount()>=1){
            // echo "date existante";
          }
          else{
            $req_insert_time="INSERT INTO `horaire`(`heure_debut`, `heure_fin`) VALUES ( :heure_debut, :heure_fin)";
            $insertion_time=$bdd->exec($req_insert_time);
            // echo "nouvelle date";
            //on relance une recherche
            $recherche_req_unique_time->execute();

          }


          $recuperation_date = $recherche_req_unique_date->fetch(PDO::FETCH_ASSOC);
          $recuperation_time = $recherche_req_unique_time->fetch(PDO::FETCH_ASSOC);

          //variable qui stock l'id de la donnée date
          $id_date_event=$recuperation_date['id_date'];
          $id_time_event=$recuperation_time['id_horaire'];

          // echo $id_img_event.'<br>';
          // echo $id_date_event.'<br>';

          $req_insert_event="INSERT INTO `evenement`( `nom_event`, `description_event`, `lieu_event`, `url_event`, `id_image`, `id_date`, `id_horaire`) VALUES ( :nom , :description ,:lieu, :url , :id_img_event , :id_date_event, :id_horaire_event)";
          $insertion_req_insert_event=$bdd->prepare($req_insert_event);
          $insertion_req_insert_event->bindParam(':nom', $nom, PDO::PARAM_STR);
          $insertion_req_insert_event->bindParam(':description', $description, PDO::PARAM_STR);
          $insertion_req_insert_event->bindParam(':lieu', $description, PDO::PARAM_STR);
          $insertion_req_insert_event->bindParam(':url', $url, PDO::PARAM_STR);
          $insertion_req_insert_event->bindParam(':id_img_event', $id_img_event, PDO::PARAM_INT);
          $insertion_req_insert_event->bindParam(':id_date_event', $id_date_event, PDO::PARAM_INT);
          $insertion_req_insert_event->bindParam(':id_horaire_event', $id_horaire_event, PDO::PARAM_INT);
          $insertion_req_insert_event->execute();
        }
        else{
          $msg='Erreur sur la recherche d\'image';
        }

      }

    }
  }
  else{

    $msg="Erreur sur les champs";
  }
}


include "../../inc/menu_2.php";

?>
<main>
  <h1 class="align">Gestion des evenements - Création </h1>
   <a href="../event.php"><i class="fas fa-arrow-circle-left"></i>
   </a>

  <div >
    <p class="resultat"><?php echo $msg; ?></p>
  </div>


  <form class="form-event" method="post" action="#">
    <label for="image">Sélectionner une image pour l'evenement *</label>
    <input type="file" name="image">

    <label for="nom">Nom de l'evenement *</label>
    <input name="nom" type="text"  placeholder="Nom de l'evenement">

    <label for="description">Description de l'evenement *</label>
    <textarea name="description" rows="10" cols="50" placeholder="Description de l'évènement"></textarea>

    <label for="lieu">Lieu de l'evenement *</label>
    <textarea name="lieu" rows="10" cols="50" placeholder="Lieu de l'évènement"></textarea>


    <label for="date_debut">Date début de l'événement</label>
    <input name="date_debut" type="date">


    <label for="date_fin">Date de fin de l'événement</label>
    <input name="date_fin" type="date">

    <label for="url">Site de l'evenements</label>
    <input name="url" type="text"  placeholder="Site de l'evenement">


    <label for="heure_debut">Heure de début</label>
    <input name="heure_debut" type="time">

    <label for="heure_fin">Heure de fin</label>
    <input name="heure_fin" type="time">

    <div class="btn-form-bloc">

        <input class="btn-reset" type="reset" name="effacer" value="Effacer">
      <input class="btn-submit" type="submit" name="enregistrer" value="Enregistrer">

    </div>
  </form>


</main>

<?php
  include "../../inc/footer.php";
?>
