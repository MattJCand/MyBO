<?php
require_once '../../inc/inc.php';


extract($_POST);

if(isset($enregistrer) && $enregistrer=="Enregistrer"){

  if(isset($image) && isset($titre) && isset($description)){
    if(empty($image)  || empty($titre) || empty($description))
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
        $req_insert_img_presse="INSERT INTO `image`(`url_img`, `date_creation_img`) VALUES (:url_img , NOW())";
        $insertion_img_presse=$bdd->prepare($req_insert_img_presse);
        $insertion_img_presse->bindParam(':url_img', $image, PDO::PARAM_STR);
        $insertion_img_presse->execute();

        // echo 'img_enregistrée<br>';

        $recherche_req_unique_img->execute();

        if($insertion_img_presse->rowCount()==1){

          $recuperation_url_img = $recherche_req_unique_img->fetch(PDO::FETCH_ASSOC);

          //stock l'id de l'image pour l'enregistrer dans l'actu qui va être créé
          $id_img_presse=$recuperation_url_img['id_img'];//***********
          // echo $id_img_actu;

          $req_insert_presse="INSERT INTO `presse`(`titre_presse`, `description_presse`, `url_presse`, `id_image`) VALUES ( :titre , :description , :url , :id_img_presse)";
          $insertion_req_insert_presse=$bdd->prepare($req_insert_presse);
          $insertion_req_insert_presse->bindParam(':titre', $titre, PDO::PARAM_STR);
          $insertion_req_insert_presse->bindParam(':description', $description, PDO::PARAM_STR);
          $insertion_req_insert_presse->bindParam(':url', $url, PDO::PARAM_STR);
          $insertion_req_insert_presse->bindParam(':id_img_presse', $id_img_presse, PDO::PARAM_INT);
          $insertion_req_insert_presse->execute();
          header('location:../presse.php');

        }
        else{
          $msg='Erreur sur la recher d\'image';
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
  <h1 class="align">Gestion des articles de presse - Création -</h1>
   <a href="../presse.php"><i class="fas fa-arrow-circle-left"></i>
   </a>

  <div >
    <p class="resultat"><?php echo $msg; ?></p>
  </div>


  <form class="form-presse" method="post" action="#">
    <label for="image">Sélectionner une image pour l'article de presse *</label>
    <input type="file" name="image">

    <label for="titre">Titre de l'article de presse *</label>
    <input name="titre" type="text"  placeholder="Titre de l'article de presse">

    <label for="description">Description de l'article de presse *</label>
    <textarea name="description" rows="10" cols="50" placeholder="Description de l'article de presse"></textarea>

    <label for="url">Site de l'article de presse</label>
    <input name="url" type="text"  placeholder="Site de l'article de presse">

    <div class="btn-form-bloc">

        <input class="btn-reset" type="reset" name="effacer" value="Effacer">
      <input class="btn-submit" type="submit" name="enregistrer" value="Enregistrer">

    </div>
  </form>


</main>

<?php
include "../../inc/footer.php";

?>

