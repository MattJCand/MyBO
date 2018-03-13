<?php

	if(!isset($_SESSION['membre'])){
		header('location:../page_connexion.php?membre=none');
	}
	else
	{
		//verification au cas ou on essaierait de se rediriger vers les autres sans se loguer
		$req_secu='SELECT * FROM Utilisateur WHERE id_user = :id AND login_user = :login AND nom_user = :nom AND prenom_user = :prenom';
		$recherche_req_secu= $bdd->prepare($req_secu);
		$recherche_req_secu->bindParam(':id',$_SESSION['membre']['id'], PDO::PARAM_STR);
		$recherche_req_secu->bindParam(':login', $_SESSION['membre']['login'], PDO::PARAM_STR);
		$recherche_req_secu->bindParam(':nom', 	$_SESSION['membre']['nom'], PDO::PARAM_STR);
		$recherche_req_secu->bindParam(':prenom', $_SESSION['membre']['prenom'], PDO::PARAM_STR);
		$recherche_req_secu->execute();


		if($recherche_req_secu->rowCount()==0){

			header('location:../page_connexion.php?req=fausse');
		}
		// else{

		// 	$resultat= $recherche_req_secu->fetch(PDO::FETCH_ASSOC);
		// 	echo 'Bonjour '.$resultat['login_user'];
		// 	// header('location:../page_connexion.php?securite=ok');
		
		// }
	}


?>
