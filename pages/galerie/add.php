<?php
require_once '../../inc/inc.php';


extract($_POST);

if(isset($enregistrer) && $enregistrer=="Enregistrer"){

  if(isset($nom) && isset($image)){
    if(empty($nom)  || empty($image))
    {
      $msg="Veuillez remplir tous les champs obligatoire s'il vous plaît";
    }
    else
    {
      //Verification si l'url de l'image existe deja dans la table galerie
      $req_unique_img="SELECT * FROM galerie WHERE url_img = :url_img";
      $recherche_req_unique_img=$bdd->prepare($req_unique_img);
      $recherche_req_unique_img->bindParam(':url_img', $image, PDO::PARAM_STR);
      $recherche_req_unique_img->execute();

      //Si l'url existe deja alors afficher un message d'erreur
      if($recherche_req_unique_img->rowCount()>=1){
        $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
      }
      else{

        $req_insert_galerie="INSERT INTO `galerie`(`nom_img`, `url_img`, `display_img` , `date_creation_img`) VALUES ( :nom , :url, 1, NOW()))";
        $insertion_req_insert_galerie=$bdd->prepare($req_insert_galerie);
        $insertion_req_insert_galerie->bindParam(':nom', $nom, PDO::PARAM_STR);
        $insertion_req_insert_galerie->bindParam(':url_img', $image, PDO::PARAM_STR);
        $insertion_req_insert_galerie->bindParam(':display_img', $display_img, PDO::PARAM_BOOL);
        $insertion_req_insert_galerie->bindParam(':date_creation_img', $date_creation_img, PDO::PARAM_STR);
        $insertion_req_insert_galerie->execute();
        header('location:../galerie.php');
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
  <h1 class="align">Gestion de la Galerie - Création -</h1>
   <a href="../galerie.php"><i class="fas fa-arrow-circle-left"></i>
   </a>

  <div >
    <p class="resultat"><?php echo $msg; ?></p>
  </div>


  <form class="form-galerie" method="post" action="#">
    <label for="image">Sélectionner une image pour la galerie *</label>
    <input type="file" name="image">

    <label for="nom">Nom de la photo *</label>
    <input name="nom" type="text"  placeholder="Nom de la photo">

    <label for="display">Affichage de la photo dans Gallerie</label>
    <input name="display" type="checkbox" value="1">

    <div class="btn-form-bloc">

        <input class="btn-reset" type="reset" name="effacer" value="Effacer">
      <input class="btn-submit" type="submit" name="enregistrer" value="Enregistrer">

    </div>
  </form>


</main>

<?php
include "../../inc/footer.php";

?>
