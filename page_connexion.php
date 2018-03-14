<?php
include "inc/inc.php"; 



//extract permet de d'importer les variables du tableau $_POST
extract($_POST);

//Vérifie sur l'utilisateur a envoyé le formulaire
if(isset($_POST['connexion']) && $_POST['connexion']=="Se connecter")
{
	//Vérifie si les variables sont définies
	if(isset($login) && isset($mdp)){

		//Vérifie si les variables ne sont pas vides
		if(empty($login) || empty($mdp)){

			header('location:page_connexion.php?connexion=echec2');
		}
		else
		{	

			$req1="SELECT * FROM Utilisateur WHERE login_user= :login AND mdp_user = 0000";
			$recherche_req1= $bdd->prepare($req1);
			$recherche_req1->bindParam(':login', $login, PDO::PARAM_STR);
			$recherche_req1->execute();

			if($recherche_req1->rowCount()==1)
			{
				$resultat= $recherche_req1->fetch(PDO::FETCH_ASSOC);

				if($resultat['mdp_user']==="0000")
				{

					$secret= password_hash($mdp, PASSWORD_DEFAULT);
					$maj= $bdd->prepare("UPDATE Utilisateur SET mdp_user = :mdp WHERE login_user = :login");
					$maj->bindParam(':login', $login, PDO::PARAM_STR);
					$maj->bindParam(':mdp', $secret, PDO::PARAM_STR);
					$maj->execute();
					header('location:page_connexion.php?action=udp_mdp');

				}
				else
				{
					

					// Vérification du code de cryptage
					$hashedPass=$resultat['mdp_user'];
					
					$isCorrect=password_verify($mdp, $hashedPass);
					echo $isCorrect;

					if($isCorrect){
						//si le code est correct alors on instance une session avec les différents données
						$_SESSION['membre']['id']=$resultat['id_user'];
						$_SESSION['membre']['login']=$resultat['login_user'];
						$_SESSION['membre']['statut']=$resultat['statut_user'];
						$_SESSION['membre']['nom']=$resultat['nom_user'];
						$_SESSION['membre']['prenom']=$resultat['prenom_user'];

						//redirection au BO
						header('location:pages/home.php');
						
					}
					else
					{	
						
						header('location:page_connexion.php?connexion=echec4');

					}
				}
				
			}
			else{

				header('location:page_connexion.php?connexion=echec3');

			}


		}
	}
	else
	{	
		header('location:page_connexion.php?connexion=echec1');
	}
}
   


//Affichage des erreurs selon les différents cas	
if(isset($_GET['connexion'])){

	if($_GET['connexion']=='echec1'){
		$msg='Erreur de l\'envoi du formulaire';

	}
	elseif($_GET['connexion']=='echec2'){
		$msg="Veuillez remplir tous les champs";
	}
	elseif($_GET['connexion']=='echec3'){
		$msg='Erreur sur le mot de passe ou le pseudo. Veuillez recommencez';
	}
	elseif($_GET['connexion']=='echec4'){
		$msg='Erreur sur le mot de passe';
	}
	elseif($_GET['connexion']=='none'){
		$msg='Veuillez vous connecter s\'il vous plaît';
	
	}
}
if(isset($_GET['action']) && $_GET['action']=='udp_mdp'){
	$msg='Mot de passe sécurisé';
}
?>

	

	<header class="align homeLogo">
	  <img src="asset_bo/img/logo_final.png" alt="logo Planete Manga">
	  <h1 class="align">Back Office</h1>
	</header>

	<main>
		<div class="container">
			<div class="login-page">
			  

			    <form class="login-form" method="post" action="">
			      
			      <input required type="text" placeholder="Nom utilisateur" name="login"/>
			      
			      <input required type="password" placeholder="Mot de passe" name="mdp"/>
			      
			      <input type="submit" name="connexion"  value="Se connecter">
			    
			    </form>
				
				<div class="container text-center">
					<p class="red-color">
						<?= $msg; ?>
					</p>
				</div>

			</div>
		</div>
	</main>

<?php include "inc/footer.php"; ?>

