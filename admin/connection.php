
<?php include "templates/pdo.php"; ?>

<div class="login-page">
  <div class="form">
    <form class="login-form" method= "POST" action="#">
      <input  required="required" type="text" placeholder="Nom utilisateur" name="login"/>
      <input  required="required" type="password" placeholder="Mot de passe" name="mdp"/>
      <button type="submit" name="valider" id="valider" >Valider</button>
    </form>
  </div>
</div>
  <?php
    if( isset($_POST['login']) && isset($_POST['mdp'])){
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $req = "SELECT * FROM administrateur WHERE login = :login AND mdp = :mdp";
        $resultat = $pdo->prepare($req);
        $resultat->bindParam(':login', $login, PDO::PARAM_STR);
        $resultat->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $resultat->execute();

      if ( $resultat->rowCount() === 1){
         session_start();
         $_SESSION['login'] = $_POST['login'];
         $_SESSION['mdp'] = $_POST['mdp'];
         header('Location: pages/home.php');
       } else {
         header('Location: index.php');
       }
     }
  ?>
