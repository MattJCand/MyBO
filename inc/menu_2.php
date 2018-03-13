<?php
include 'inc.php';

if(isset($_GET['action']) && $_GET['action']=='deconnexion'){
  session_destroy();
  // header('location:page_connexion.php?deconnexion=success');
  header('location:../../page_connexion.php');
}

if(!isset($_SESSION['membre'])){
    header('location:../../page_connexion.php?membre=none');
  }
  else
  {
    //verification au cas ou on essaierait de se rediriger vers les autres sans se loguer
    $req_secu='SELECT * FROM Utilisateur WHERE id_user = :id AND login_user = :login AND nom_user = :nom AND prenom_user = :prenom';
    $recherche_req_secu= $bdd->prepare($req_secu);
    $recherche_req_secu->bindParam(':id',$_SESSION['membre']['id'], PDO::PARAM_STR);
    $recherche_req_secu->bindParam(':login', $_SESSION['membre']['login'], PDO::PARAM_STR);
    $recherche_req_secu->bindParam(':nom',  $_SESSION['membre']['nom'], PDO::PARAM_STR);
    $recherche_req_secu->bindParam(':prenom', $_SESSION['membre']['prenom'], PDO::PARAM_STR);
    $recherche_req_secu->execute();


    if($recherche_req_secu->rowCount()==0){

      header('location:../../page_connexion.php?req=fausse');
    }
    // else{

    //  $resultat= $recherche_req_secu->fetch(PDO::FETCH_ASSOC);
    //  echo 'Bonjour '.$resultat['login_user'];
    //  // header('location:../page_connexion.php?securite=ok');
    
    // }
  }

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Back Office</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
   
    <link rel='stylesheet' href='../../asset/css/style.css' />
  </head>
<body>


  <header>
    <div class="container">
      <div class="bloc-logo-nav">
        <a href="../home.php">
          <img src="../../asset/img/logo_final.png" alt="logo Planete Manga">
        </a>
      </div>

      <nav class="menu majuscule">
        <ul class="text-center">
          <li><a href="home.php">Accueil</a></li>
          <li class="submenu"><a href="#"">L'école</a>
            <ul>
              <li><a href="../actu.php">Actualité</a></li>
              <li><a href="../galerie.php">Galerie</a></li>
               <li><a href="../member.php">Carte Membre</a></li>
            </ul>
          </li>
          <li><a href="../cours.php">Cours</a></li>
          <li><a href="../team.php">Equipe</a></li>
          <li class="submenu"><a href="#">Divers</a>
            <ul>
              <!-- <li><a href="pages/event/event.php">Evénements</a></li> -->
              <li><a href="../presse.php">Presse</a></li>
            </ul>
          </li>
          <li><a href="../partner.php">Nos partenaires</a></li>
          <li><a href="?action=deconnexion">Déconnexion</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="spacer"></div>
