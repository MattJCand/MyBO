<?php
require_once '../../inc/inc.php';

extract($_GET);


if(isset($id) && !empty($id)){
    $req_verif_partenaire="SELECT * FROM partenaire p, image i WHERE p.id_image=i.id_img AND id_partenaire= :id";
    $recherche_req_verif_partenaire=$bdd->prepare($req_verif_partenaire);
    $recherche_req_verif_partenaire->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_partenaire->execute();

    if($recherche_req_verif_partenaire->rowCount()==0){
        header('location:../partner.php?id=inconnu');
    }
    else{
        $resultat_req_verif_partenaire= $recherche_req_verif_partenaire->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../partner.php?id=nontrouve');
}




extract($_POST);
extract($_FILES);


if(isset($modifier) && $modifier=="Modifier"){
                

    if(isset($nom_partenaire) && isset($description_partenaire)  && isset($adresse_partenaire) &&  isset($logo_partenaire) ){

        if(empty($nom_partenaire) || empty($description_partenaire) || empty($adresse_partenaire)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }
        else{


            if(empty($logo_partenaire['name'])){

                $logo_partenaire_udp= $resultat_req_verif_partenaire['url_img'];

                //requete de mise a jour
                $req_udp_partenaire="
                UPDATE partenaire p, image i 
                SET 
                    i.url_img = :logo_partenaire_udp , 
                    i.date_creation_img = NOW() , 
                    p.nom_partenaire = :nom_partenaire_udp , 
                    p.description_partenaire = :description_partenaire_udp , 
                    p.url_partenaire = :url_partenaire_udp , 
                    p.adresse_partenaire = :adresse_partenaire_udp 
                WHERE 
                    p.id_image = i.id_img 
                AND 
                    p.id_partenaire = :id ";

                $recherche_req_udp_partenaire=$bdd->prepare($req_udp_partenaire);
                $recherche_req_udp_partenaire->bindParam(':id', $id, PDO::PARAM_INT);
                $recherche_req_udp_partenaire->bindParam(':logo_partenaire_udp', $logo_partenaire_udp, PDO::PARAM_STR);
                $recherche_req_udp_partenaire->bindParam(':nom_partenaire_udp', $nom_partenaire, PDO::PARAM_STR);
                $recherche_req_udp_partenaire->bindParam(':description_partenaire_udp', $description_partenaire, PDO::PARAM_STR);
                $recherche_req_udp_partenaire->bindParam(':adresse_partenaire_udp', $adresse_partenaire, PDO::PARAM_STR);
                $recherche_req_udp_partenaire->bindParam(':url_partenaire_udp', $url_partenaire, PDO::PARAM_STR);
                $recherche_req_udp_partenaire->execute();

                header('location:../partner.php?udp=success1');


            }
            else
            {   
                
                //Verification si l'url de l'image existe deja dans la table image
                $req_unique_img="SELECT * FROM image WHERE url_img = :logo_partenaire";
                $recherche_req_unique_img=$bdd->prepare($req_unique_img);
                $recherche_req_unique_img->bindParam(':logo_partenaire', $logo_partenaire['name'], PDO::PARAM_STR);
                $recherche_req_unique_img->execute();

                //Si l'url existe deja alors afficher un message d'erreur
                if($recherche_req_unique_img->rowCount()>=1){
                    $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
                }
                else{
                    $name_img=$resultat_req_verif_partenaire['url_img'];
                    unlink('../../upload_img/partenaire/'.$name_img);


                    ////UPLOAD File
                    if(isset($_FILES["logo_partenaire"]["type"]))
                    {

                        $validextensions = array("jpeg", "jpg", "png");
                        $temporary = explode(".", $_FILES["logo_partenaire"]["name"]);
                        $file_extension = end($temporary);


                        if ((($_FILES["logo_partenaire"]["type"] == "image/png") || ($_FILES["logo_partenaire"]["type"] == "image/jpg") || ($_FILES["logo_partenaire"]["type"] == "image/jpeg")
                        ) && ($_FILES["logo_partenaire"]["size"] < 1048576) // taille max : 1Mo
                        && in_array($file_extension, $validextensions)) 
                        {


                            if ($_FILES["logo_partenaire"]["error"] > 0)
                            {
                            $msg= "Return Code: " . $_FILES["image"]["error"] . "<br/><br/>";
                            }
                            else
                            {

                                if (file_exists("../../upload_img/partenaire/" . $_FILES["logo_partenaire"]["name"])) {

                                    $msg=$_FILES["logo_partenaire"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
                                }
                                else
                                {
                                    $sourcePath = $_FILES['logo_partenaire']['tmp_name']; // Storing source path of the file in a variable

                                    $targetPath = "../../upload_img/partenaire/".$_FILES['logo_partenaire']['name']; // Target path where file is to be stored
                                    move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                                    
                                    //requete de mise a jour
                                    $req_udp_partenaire="
                                    UPDATE partenaire p, image i 
                                    SET 
                                        i.url_img= :logo_partenaire_udp ,
                                        i.date_creation_img= NOW(),
                                        p.nom_partenaire= :nom_partenaire_udp,
                                        p.description_partenaire= :description_partenaire_udp,
                                        p.url_partenaire= :url_partenaire_udp ,
                                        p.adresse_partenaire= :adresse_partenaire_udp 
                                    WHERE 
                                        p.id_image=i.id_img
                                    AND p.id_partenaire= :id " ;

                                    $recherche_req_udp_partenaire=$bdd->prepare($req_udp_partenaire);
                                    $recherche_req_udp_partenaire->bindParam(':id', $id, PDO::PARAM_INT);
                                    $recherche_req_udp_partenaire->bindParam(':nom_partenaire_udp', $nom_partenaire, PDO::PARAM_STR);
                                    $recherche_req_udp_partenaire->bindParam(':description_partenaire_udp', $description_partenaire, PDO::PARAM_STR);
                                    $recherche_req_udp_partenaire->bindParam(':adresse_partenaire_udp', $adresse_partenaire, PDO::PARAM_STR);
                                    $recherche_req_udp_partenaire->bindParam(':url_partenaire_udp', $url_partenaire, PDO::PARAM_STR);
                                    $recherche_req_udp_partenaire->bindParam(':logo_partenaire_udp', $logo_partenaire['name'], PDO::PARAM_STR);
                                    $recherche_req_udp_partenaire->execute();

                                    header('location:../partner.php?udp=success2');

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
    <h1 class="text-center">Gestion des partenaire - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-partner" method="post" action="#" enctype="multipart/form-data">

        <label for="logo_partenaire">logo du partenaire :</label>

        <div class="edit-img-bloc">  
            <img src="../../upload_img/partenaire/<?php echo htmlentities($resultat_req_verif_partenaire['url_img']); ?>" alt="<?php echo htmlentities($resultat_req_verif_partenaire['url_img']); ?>">
        </div> 
        
        <input type="file" name="logo_partenaire">

        <label for="nom_partenaire">Nom du partenaire:</label>
        <input type="text" name="nom_partenaire" value="<?php echo htmlentities($resultat_req_verif_partenaire['nom_partenaire']);?>">

        <label for="description_partenaire">Description du partenaire:</label>
        <textarea name="description_partenaire" rows="10" cols="50" ><?php echo htmlentities($resultat_req_verif_partenaire['description_partenaire']);?></textarea>

        <label for="adresse_partenaire">Adresse du partenaire:</label>
        <input type="text" name="adresse_partenaire" value="<?php echo htmlentities($resultat_req_verif_partenaire['adresse_partenaire']);?>">

        <label for="url_partenaire">Site du partenaire:</label>
        <input type="text" name="url_partenaire" value="<?php echo htmlentities($resultat_req_verif_partenaire['url_partenaire']);?>">

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>