<?php
require_once '../../inc/inc.php';

// echo '<pre>';
//   print_r($_FILES);
// echo '</pre>';
// echo '<pre>';
//   print_r($_POST);
// echo '</pre>';

extract($_POST);
extract($_FILES);

if(isset($enregistrer) && $enregistrer=="Enregistrer"){

  if(isset($image) && isset($nom)  && isset($description) && isset($lieu) && isset($date_debut) && isset($date_fin)  && isset($url)  && isset($heure_debut) && isset($heure_fin)){


    if(empty($image)  || empty($nom) || empty($description) || empty($lieu) || empty($date_debut) || empty($date_fin) || empty($heure_debut) || empty($heure_fin))
    {
      $msg="Veuillez remplir tous les champs obligatoire s'il vous plaît";
    }
    else
    {


      //Verification si l'url de l'image existe deja dans la table image
      $req_unique_img="SELECT * FROM image WHERE url_img = :url_img";
      $recherche_req_unique_img=$bdd->prepare($req_unique_img);
      $recherche_req_unique_img->bindParam(':url_img', $image['name'], PDO::PARAM_STR);
      $recherche_req_unique_img->execute();

      //Si l'url existe deja alors afficher un message d'erreur
      if($recherche_req_unique_img->rowCount()>=1){
        $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
      }
      else{


        ////UPLOAD File
        if(isset($_FILES["image"]["type"]))
        {
          $validextensions = array("jpeg", "jpg", "png");
          $temporary = explode(".", $_FILES["image"]["name"]);
          $file_extension = end($temporary);

          if ((($_FILES["image"]["type"] == "image/png") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/jpeg")
          ) && ($_FILES["image"]["size"] < 1048576) // taille max : 1Mo
          && in_array($file_extension, $validextensions)) 
          {


            if ($_FILES["image"]["error"] > 0)
            {
              $msg = "Return Code: " . $_FILES["image"]["error"] . "<br/><br/>";
            }
            else
            {
              if (file_exists("../../upload_img/evenement/" . $_FILES["image"]["name"])) {
                $msg= $_FILES["image"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
              }
              else
              {
                $sourcePath = $_FILES['image']['tmp_name']; 
                $targetPath = "../../upload_img/evenement/".$_FILES['image']['name']; 

                //enregistrement de l'image dans le dossier
                move_uploaded_file($sourcePath,$targetPath) ; 
                //Enregistrement de l'image dans la bdd

                //Enregistrement de l'image dans la bdd
                $req_insert_img_event="INSERT INTO `image`(`url_img`, `date_creation_img`) VALUES (:url_img , NOW())";
                $insertion_img_event=$bdd->prepare($req_insert_img_event);
                $insertion_img_event->bindParam(':url_img', $image['name'], PDO::PARAM_STR);
                $insertion_img_event->execute();

                 $recherche_req_unique_img->execute();

                  if($recherche_req_unique_img->rowCount()==1)
                  {

                      $recuperation_url_img = $recherche_req_unique_img->fetch(PDO::FETCH_ASSOC);

                      //stock l'id de l'image pour l'enregistrer dans l'event qui va être créé
                      $id_img_event=$recuperation_url_img['id_img'];//***********


                      //Verification si la date existe deja dans la table date
                      $req_unique_date="SELECT * FROM date WHERE date_debut = :date_d AND date_fin = :date_f";
                      $recherche_req_unique_date=$bdd->prepare($req_unique_date);
                      $recherche_req_unique_date->bindParam(':date_d', $date_debut, PDO::PARAM_STR);
                      $recherche_req_unique_date->bindParam(':date_f', $date_fin, PDO::PARAM_STR);
                      $recherche_req_unique_date->execute();

                      if($recherche_req_unique_date->rowCount()>=1){
                        // echo "date existante";
                      }
                      else{
                        $req_insert_date="INSERT INTO `date`(`date_debut`, `date_fin`) VALUES ( :date_debut, :date_fin)";
                        $insertion_req_insert_date=$bdd->prepare($req_insert_date);
                        $insertion_req_insert_date->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
                        $insertion_req_insert_date->bindParam(':date_fin', $date_fin, PDO::PARAM_STR);

                        $insertion_req_insert_date->execute();
                        // echo "nouvelle date";
                        //on relance une recherche
                        $recherche_req_unique_date->execute();
                      }

                      $recuperation_date=$recherche_req_unique_date->fetch(PDO::FETCH_ASSOC);

                      $id_date_event=$recuperation_date['id_date'];


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
                        $insertion_req_insert_time=$bdd->prepare($req_insert_time);
                        $insertion_req_insert_time->bindParam(':heure_debut', $heure_debut, PDO::PARAM_STR);
                        $insertion_req_insert_time->bindParam(':heure_fin', $heure_fin, PDO::PARAM_STR);
                        $insertion_req_insert_time->execute();

                        // echo "nouvelle date";
                        //on relance une recherche
                        $recherche_req_unique_time->execute();

                      }


                     
                      $recuperation_time = $recherche_req_unique_time->fetch(PDO::FETCH_ASSOC);

                      //variable qui stock l'id de la donnée horaire
                      $id_time_event=$recuperation_time['id_horaire'];

                  
                      $req_insert_event="INSERT INTO `evenement`( `nom_event`, `description_event`, `lieu_event`, `url_event`, `id_image`, `id_date`, `id_horaire`) VALUES ( :nom , :description ,:lieu, :url , :id_img_event , :id_date_event, :id_horaire_event)";
                      $insertion_req_insert_event=$bdd->prepare($req_insert_event);
                      $insertion_req_insert_event->bindParam(':nom', $nom, PDO::PARAM_STR);
                      $insertion_req_insert_event->bindParam(':description', $description, PDO::PARAM_STR);
                      $insertion_req_insert_event->bindParam(':lieu', $description, PDO::PARAM_STR);
                      $insertion_req_insert_event->bindParam(':url', $url, PDO::PARAM_STR);
                      $insertion_req_insert_event->bindParam(':id_img_event', $id_img_event, PDO::PARAM_INT);
                      $insertion_req_insert_event->bindParam(':id_date_event', $id_date_event, PDO::PARAM_INT);
                      $insertion_req_insert_event->bindParam(':id_horaire_event', $id_time_event, PDO::PARAM_INT);
                      $insertion_req_insert_event->execute();

                      header('location:../event.php?creation=success');
                  }
                  else{
                    $msg='Erreur sur la recherche d\'image';
                  }   
                
              }
              
            }
      

          } 
        

        }////////***********

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


  <form class="form-event" method="post" action="#" enctype="multipart/form-data">
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

    <label for="heure_debut">Heure de début</label>
    <input name="heure_debut" type="time">

    <label for="heure_fin">Heure de fin</label>
    <input name="heure_fin" type="time">

    <label for="url">Site de l'evenements</label>
    <input name="url" type="text"  placeholder="Site de l'evenement">


   

    <div class="btn-form-bloc">

        <input class="btn-reset" type="reset" name="effacer" value="Effacer">
      <input class="btn-submit" type="submit" name="enregistrer" value="Enregistrer">

    </div>
  </form>


</main>

<?php
  include "../../inc/footer.php";
?>
