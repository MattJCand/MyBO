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
				$req_insert_img_actu="INSERT INTO `image`(`id_img`, `url_img`, `date_creation_img`) VALUES ('', :url_img , NOW())";
				$insertion_img_actu=$bdd->prepare($req_insert_img_actu);
				$insertion_img_actu->bindParam(':url_img', $image, PDO::PARAM_STR);
				$insertion_img_actu->execute();

				// echo 'img_enregistrée<br>';

				$recherche_req_unique_img->execute();

				if($insertion_img_actu->rowCount()==1){

					$recuperation_url_img = $recherche_req_unique_img->fetch(PDO::FETCH_ASSOC);

					//stock l'id de l'image pour l'enregistrer dans l'actu qui va être créé
					$id_img_actu=$recuperation_url_img['id_img'];//***********
					// echo $id_img_actu;

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
						$req_insert_date="INSERT INTO `date`(`id_date`, `date_debut`, `date_fin`) VALUES ('', NOW(),'')";
						$insertion_date=$bdd->exec($req_insert_date);
						// echo "nouvelle date";
						//on relance une recherche
						$recherche_req_unique_date->execute();

					}
					$recuperation_date = $recherche_req_unique_date->fetch(PDO::FETCH_ASSOC);

					//variable qui stock l'id de la donnée date
					$id_date_actu=$recuperation_date['id_date'];

					// echo $id_img_actu.'<br>';
					// echo $id_date_actu.'<br>';

					$req_insert_actu="INSERT INTO `actualite`(`id_actu`, `titre_actu`, `description_actu`, `url_actu`, `id_image`, `id_date`) VALUES ('', :titre , :description , :url , :id_img_actu , :id_date_actu)";
					$insertion_req_insert_actu=$bdd->prepare($req_insert_actu);
					$insertion_req_insert_actu->bindParam(':titre', $titre, PDO::PARAM_STR);
					$insertion_req_insert_actu->bindParam(':description', $description, PDO::PARAM_STR);
					$insertion_req_insert_actu->bindParam(':url', $url, PDO::PARAM_STR);
					$insertion_req_insert_actu->bindParam(':id_img_actu', $id_img_actu, PDO::PARAM_INT);
					$insertion_req_insert_actu->bindParam(':id_date_actu', $id_date_actu, PDO::PARAM_INT);
					$insertion_req_insert_actu->execute();
					header('location:../actu.php');

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
	<h1 class="align">Gestion des actualités - Création -</h1>
	 <a href="../actu.php"><i class="fas fa-arrow-circle-left"></i>
	 </a>

	<div >
		<p class="resultat"><?php echo $msg; ?></p>
	</div>


	<form class="form-actu" method="post" action="#">
		<label for="image">Sélectionner une image pour l'actualité *</label>
		<input type="file" name="image">

		<label for="titre">Titre de l'actualité *</label>
		<input name="titre" type="text"  placeholder="Titre de l'actualité">

		<label for="description">Description de l'actualité *</label>
		<textarea name="description" rows="10" cols="50" placeholder="Description de l'évènement"></textarea>

		<label for="url">Site de l'actualité</label>
		<input name="url" type="text"  placeholder="Site de l'actualité">

		<div class="btn-form-bloc">

		    <input class="btn-reset" type="reset" name="effacer" value="Effacer">
			<input class="btn-submit" type="submit" name="enregistrer" value="Enregistrer">

		</div>
	</form>


</main>

<?php
include "../../inc/footer.php";

?>
