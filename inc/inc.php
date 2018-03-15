<?php
session_start();//Démarage de la session

$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND 	=> 'SET NAMES utf8', //forcer l'encodage en utf-8
			PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_WARNING, //affichage des erreurs
			PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC //récupérer les informations sous forme de tableau associatif
		);

try{
	$bdd= new PDO( 'mysql:host=localhost;dbname=planetemanga_bd4','root','root', $options);
}
catch(Exception $e){
	die('Erreur lors de la connexion de la base de données: '.$e -> getMessage());
	//La fonction die() permet de stopper l'éxécution du script
}

$msg="";
?>
