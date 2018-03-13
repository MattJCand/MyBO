<?php 
include 'inc.php';
	//Si GET contient la variable action qui a la valeur deconnexion alors la session se termine + redirection sur la page d'accueil
if(isset($_GET['action']) && $_GET['action']=='deconnexion'){
	session_destroy();
	// header('location:page_connexion.php?deconnexion=success');
	header('location:../page_connexion.php');
}

?>





