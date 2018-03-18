<?php
require_once '../../inc/inc.php';

extract($_GET);
extract($_FILES);

if(isset($id) && !empty($id)){
    $req_verif_actu="SELECT * FROM actualite a, image i, date d WHERE a.id_image=i.id_img AND a.id_date = d.id_date AND id_actu= :id";
    $recherche_req_verif_actu=$bdd->prepare($req_verif_actu);
    $recherche_req_verif_actu->bindParam(':id', $id, PDO::PARAM_INT);
    $recherche_req_verif_actu->execute();

    if($recherche_req_verif_actu->rowCount()==0){
        header('location:../actu.php?id=inconnu');
    }
    else{
        $resultat_req_verif_actu= $recherche_req_verif_actu->fetch(PDO::FETCH_ASSOC);
    }

}
else{
    header('location:../actu.php?id=nontrouve');
}

extract($_POST);
extract($_FILES);

if(isset($modifier) && $modifier=="Modifier"){

    if(isset($img_actu) && isset($titre_actu) && isset($description_actu)){

        if(empty($titre_actu) || empty($description_actu)){
            $msg="Un ou plusieurs des champs obligatoires sont vides";
        }
        else{
            $date_now=date("Y-m-d");

        if(empty($img_actu['name'])){
                $img_actu_udp=$resultat_req_verif_actu['url_img'];


                $req_udp_actu="
                UPDATE actualite a, image i, date d
                SET 
                    i.url_img = :img_actu_udp , 
                    i.date_creation_img = NOW() ,
                    d.date_debut= :date_now , 
                    a.titre_actu = :titre_actu_udp , 
                    a.description_actu = :description_actu_udp , 
                    a.url_actu = :url_actu_udp
                WHERE 
                    a.id_image = i.id_img
                AND 
                    a.id_date = d.id_date
                AND 
                    a.id_actu = :id";
                $recherche_req_udp_actu=$bdd->prepare($req_udp_actu);
                $recherche_req_udp_actu->bindParam(':id', $id, PDO::PARAM_INT);
                $recherche_req_udp_actu->bindParam(':img_actu_udp', $img_actu_udp, PDO::PARAM_STR);
                $recherche_req_udp_actu->bindParam(':titre_actu_udp', $titre_actu, PDO::PARAM_STR);
                $recherche_req_udp_actu->bindParam(':description_actu_udp', $description_actu, PDO::PARAM_STR);
                $recherche_req_udp_actu->bindParam(':date_now', $date_now, PDO::PARAM_STR);
                $recherche_req_udp_actu->bindParam(':url_actu_udp', $url_actu, PDO::PARAM_STR);
                $recherche_req_udp_actu->execute();

                header('location:../actu.php?udp=success1');
            }
            else{

                //Verification si l'url de l'image existe deja dans la table image
                $req_unique_img="SELECT * FROM image WHERE url_img = :img_actu";
                $recherche_req_unique_img=$bdd->prepare($req_unique_img);
                $recherche_req_unique_img->bindParam(':img_actu', $img_actu['name'], PDO::PARAM_STR);
                $recherche_req_unique_img->execute();            

                 //Si l'url existe deja alors afficher un message d'erreur
                if($recherche_req_unique_img->rowCount()>=1){
                    $msg='cette url d\'image existe deja. Renommer votre image S\'il vous plaît.';
                }
                else{
                    $name_img=$resultat_req_verif_actu['url_img'];
                    unlink('../../upload_img/actualite/'.$name_img);

                    ////UPLOAD File
                    if(isset($_FILES["img_actu"]["type"]))
                    {

                        $validextensions = array("jpeg", "jpg", "png");
                        $temporary = explode(".", $_FILES["img_actu"]["name"]);
                        $file_extension = end($temporary);


                        if ((($_FILES["img_actu"]["type"] == "image/png") || ($_FILES["img_actu"]["type"] == "image/jpg") || ($_FILES["img_actu"]["type"] == "image/jpeg")
                        ) && ($_FILES["img_actu"]["size"] < 1048576) // taille max : 1Mo
                        && in_array($file_extension, $validextensions)) 
                        {


                            if ($_FILES["img_actu"]["error"] > 0)
                            {
                            $msg= "Return Code: " . $_FILES["image"]["error"] . "<br/><br/>";
                            }
                            else
                            {

                                if (file_exists("../../upload_img/" . $_FILES["img_actu"]["name"])) {

                                    $msg=$_FILES["img_actu"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
                                }
                                else
                                {
                                    $sourcePath = $_FILES['img_actu']['tmp_name']; // Storing source path of the file in a variable

                                    $targetPath = "../../upload_img/actualite/".$_FILES['img_actu']['name']; // Target path where file is to be stored
                                    move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                                    
                                    //requete de mise a jour
                                    $req_udp_actu="
                                    UPDATE actualite a, image i
                                    SET 
                                        i.url_img = :img_actu_udp , 
                                        a.titre_actu = :titre_actu_udp , 
                                        a.description_actu = :description_actu_udp , 
                                        a.url_actu = :url_actu_udp
                                    WHERE 
                                        a.id_image = i.id_img
                                    AND 
                                        a.id_actu = :id";

                                    $recherche_req_udp_actu=$bdd->prepare($req_udp_actu);
                                    $recherche_req_udp_actu->bindParam(':id', $id, PDO::PARAM_INT);
                                    $recherche_req_udp_actu->bindParam(':img_actu_udp', $img_actu['name'], PDO::PARAM_STR);
                                    $recherche_req_udp_actu->bindParam(':titre_actu_udp', $titre_actu, PDO::PARAM_STR);
                                    $recherche_req_udp_actu->bindParam(':description_actu_udp', $description_actu, PDO::PARAM_STR);
                                    $recherche_req_udp_actu->bindParam(':url_actu_udp', $url_actu, PDO::PARAM_STR);
                                    $recherche_req_udp_actu->execute();

                                    header('location:../actu.php?udp=success2');

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
    <h1 class="text-center">Gestion des actualités - Edition -</h1>

    <div>
        <p class="resultat"><?php echo $msg; ?></p>
    </div>

    <form class="form-actu" method="post" action="#" enctype="multipart/form-data">
        <label for="img_actu">Image de l'actu :</label>
        <div class="edit-img-bloc">  

        <img src="../../upload_img/actualite/<?php echo $resultat_req_verif_actu['url_img']; ?>" alt="<?php echo $resultat_req_verif_actu['url_img']; ?>">

        </div> 
        
        <input type="file" name="img_actu">

        <label for="titre_actu">Titre de l'actualité:</label>
        <input type="text" name="titre_actu" value="<?php echo $resultat_req_verif_actu['titre_actu'];?>">

        <label for="description_actu">Description de l'actualité:</label>
        <textarea name="description_actu" rows="10" cols="50" ><?php echo $resultat_req_verif_actu['description_actu'];?></textarea>

        <label for="url_actu"></label>
        <input type="text" name="url_actu" value="<?php echo $resultat_req_verif_actu['url_actu'];?>">

        <div class="btn-form-bloc">

            <input class="btn-reset" type="reset" name="effacer" value="Effacer">
            <input class="btn-submit" type="submit" name="modifier" value="Modifier">

        </div>

    </form>



</main>


<?php
include "../../inc/footer.php";

 ?>