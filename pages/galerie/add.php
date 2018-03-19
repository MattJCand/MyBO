<?php
require_once '../../inc/inc.php';

// echo '<pre>';
//  print_r($_FILES);
// echo '</pre>';

extract($_POST);
extract($_FILES);

if(isset($enregistrer) && $enregistrer=="Enregistrer"){

  if(isset($nom) && isset($image)){

    if(isset($nom) && isset($image))
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
      else
      {
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
              if (file_exists("../../upload_img/presse/" . $_FILES["image"]["name"])) {
                $msg= $_FILES["image"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
              }
              else
              {
                $sourcePath = $_FILES['image']['tmp_name'];
                $targetPath = "../../upload_img/presse/".$_FILES['image']['name'];

                //enregistrement de l'image dans le dossier
                move_uploaded_file($sourcePath,$targetPath) ;
                //Enregistrement de l'image dans la bdd

               $req_insert_galerie="INSERT INTO `galerie`(`nom_img`, `url_img`, `date_creation_img`) VALUES ( :nom , :url, 1, NOW()))";
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

  <div>
    <p class="resultat text-center"><?php echo $msg; ?></p>

  </div>


  <form class="form-galerie" method="post" action="#" enctype="multipart/form-data">

     <label for="image">Sélectionner une image pour la galerie * (MAX : 1Mo)</label>
    <input type="file" name="image" >

    <label for="nom">Nom de la photo *</label>
    <input name="nom" type="text"  placeholder="Nom de la photo">

    <div class="btn-form-bloc">

        <input class="btn-reset" type="reset" name="effacer" value="Effacer">
      <input class="btn-submit" type="submit" name="enregistrer" value="Enregistrer">

    </div>
  </form>


</main>

<?php
include "../../inc/footer.php";

?>

