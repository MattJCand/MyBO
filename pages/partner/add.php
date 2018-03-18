<?php
require_once '../../inc/inc.php';

extract($_POST);


if(isset($enregistrer) && $enregistrer=="Enregistrer"){

  if(isset($image) && isset($nom) && isset($description) && isset($adresse)){

    if(empty($image)  || empty($nom) && isset($description) && isset($adresse))
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
        $req_insert_img_partenaire="INSERT INTO `image`(`url_img`, `date_creation_img`) VALUES (:url_img , NOW())";
        $insertion_req_insert_img_partenaire=$bdd->prepare($req_insert_img_partenaire);
        $insertion_req_insert_img_partenaire->bindParam(':url_img', $image, PDO::PARAM_STR);
        $insertion_req_insert_img_partenaire->execute();


        //on recherche l'image qui vient d'être créer
        $recherche_req_unique_img->execute();

        if($insertion_req_insert_img_partenaire->rowCount()==1){

          $recuperation_url_img = $recherche_req_unique_img->fetch(PDO::FETCH_ASSOC);

          //stock l'id de l'image pour l'enregistrer dans l'actu qui va être créé
          $id_img_partenaire=$recuperation_url_img['id_img'];//***********
          // echo $id_img_actu;


          $req_insert_partenaire="INSERT INTO `partenaire`(`nom_partenaire`, `description_partenaire`, `adresse_partenaire`, `url_partenaire`, `id_image`) VALUES (:nom , :description ,:adresse , :url ,:id_img_partenaire)";
          $insertion_req_insert_partenaire=$bdd->prepare($req_insert_partenaire);
          $insertion_req_insert_partenaire->bindParam(':nom', $nom, PDO::PARAM_STR);
          $insertion_req_insert_partenaire->bindParam(':description', $description, PDO::PARAM_STR);
          $insertion_req_insert_partenaire->bindParam(':adresse', $adresse, PDO::PARAM_STR);
          $insertion_req_insert_partenaire->bindParam(':url', $url, PDO::PARAM_STR);
          $insertion_req_insert_partenaire->bindParam(':id_img_partenaire', $id_img_partenaire, PDO::PARAM_INT);
          $insertion_req_insert_partenaire->execute();

          header('location:../partner.php');

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

  <h1 class="text-center">Gestion des partenaires - Création -</h1>
  <a href="../partner.php">
    <i class="fas fa-arrow-circle-left"></i>
  </a>


  <div >
    <p class="resultat"><?php echo $msg; ?></p>
  </div>

  <form class="form-actu" method="post" action="#">
    <label for="image">Sélectionner une image pour le partenaire *</label>
    <input type="file" name="image">

    <label for="nom">Nom du partenaire *</label>
    <input name="nom" type="text"  placeholder="Nom du partenaire">


    <label for="adresse">Adresse du partenaire</label>
    <input name="adresse" type="text"  placeholder="Adresse du partenaire">

    <label for="description">Description du partenaire *</label>
    <textarea name="description" rows="10" cols="50" placeholder="Description du partenaire"></textarea>


    <label for="url">Site du partenaire</label>
    <input name="url" type="text"  placeholder="Site du partenaire">

    <div class="btn-form-bloc">

        <input class="btn-reset" type="reset" name="effacer" value="Effacer">
      <input class="btn-submit" type="submit" name="enregistrer" value="Enregistrer">

    </div>
  </form>


</main>


<?php
include "../../inc/footer.php";

?>
