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
        $req_insert_img_prof="INSERT INTO `image`(`id_img`, `url_img`, `date_creation_img`) VALUES ('', :url_img , NOW())";
        $insertion_img_prof=$bdd->prepare($req_insert_img_prof);
        $insertion_img_prof->bindParam(':url_img', $image, PDO::PARAM_STR);
        $insertion_img_prof->execute();

        // echo 'img_enregistrée<br>';

        $recherche_req_unique_img->execute();

        if($insertion_img_prof->rowCount()==1){

          $recuperation_url_img = $recherche_req_unique_img->fetch(PDO::FETCH_ASSOC);

          //stock l'id de l'image pour l'enregistrer pour le professeur qui va être créé
          $id_img_prof=$recuperation_url_img['id_img'];//***********
          // echo $id_img_prof;

          $req_insert_professeur="INSERT INTO `professeur`(`id_prof`, `nom_prof`, `prenom_prof`, `description_prof`, `email_prof`,        `profession_prof`, `tarif_prof`, `id_image`) VALUES ('', :nom , :prenom, :description , :email , :profession, :tarif :id_img_prof )";
          $insertion_req_insert_professeur=$bdd->prepare($req_insert_professeur);
          $insertion_req_insert_professeur->bindParam(':nom', $nom, PDO::PARAM_STR);
          $insertion_req_insert_professeur->bindParam(':prenom', $prenom, PDO::PARAM_STR);
          $insertion_req_insert_professeur->bindParam(':description', $description, PDO::PARAM_STR);
          $insertion_req_insert_professeur->bindParam(':email', $email, PDO::PARAM_STR);
          $insertion_req_insert_professeur->bindParam(':profession', $profession, PDO::PARAM_STR);
          $insertion_req_insert_professeur->bindParam(':tarif', $tarif, PDO::PARAM_STR);
          $insertion_req_insert_professeur->bindParam(':id_img_prof', $id_img_prof, PDO::PARAM_INT);
          $insertion_req_insert_professeur->execute();
          header('location:../team.php');

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
  <h1 class="align">Gestion des Professeurs - Création -</h1>
   <a href="../team.php"><i class="fas fa-arrow-circle-left"></i>
   </a>

  <div >
    <p class="resultat"><?php echo $msg; ?></p>
  </div>


  <form class="form-prof" method="post" action="#">
    <label for="image">Sélectionner une image de profil *</label>
    <input type="file" name="image">

    <label for="nom">Nom du professeur *</label>
    <input name="nom" type="text"  placeholder="Nom du professeur">

    <label for="prenom">Prenom du professeur *</label>
    <input name="prenom" type="text"  placeholder="Prenom du professeur">

    <label for="description">Description du professeur *</label>
    <textarea name="description" rows="10" cols="50" placeholder="Description du professeur"></textarea>

    <label for="email">Email du professeur *</label>
    <input name="email" type="text"  placeholder="prof@gmail.com">

    <label for="profession">Profession du professeur</label>
    <input name="profession" type="text"  placeholder="Profession du professeur">

    <label for="tarif">Tarif du professeur €</label>
    <input name="tarif" type="number"  placeholder="15">

    <div class="btn-form-bloc">

        <input class="btn-reset" type="reset" name="effacer" value="Effacer">
      <input class="btn-submit" type="submit" name="enregistrer" value="Enregistrer">

    </div>
  </form>


</main>

<?php
include "../../inc/footer.php";

?>


