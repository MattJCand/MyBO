
<?php include "templates/pdo.php"; ?>
<div class="conteneur">
<fieldset>
  <form method="post" action="home.php">
    <label>Nom utilisateur</label>
    <input type="text" name="pseudo"><br>
    <label>Mot de passe</label>
    <input type="text" name="mdp"><br>
    <input type="submit" value="valider" name="valider" id="valider">
  </form>
</fieldset>
<hr>
<fieldset>
  <?php
    if( isset($_POST['pseudo']) && isset($_POST['mdp'])){
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];
        $req = "SELECT * FROM login WHERE pseudo = :pseudo AND mdp = :mdp";
        $resultat = $pdo->prepare($req);
        $resultat->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $resultat->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $resultat->execute();

      if ( $resultat->rowCount() === 1){
         $user = $resultat->fetch(PDO::FETCH_ASSOC);
         echo '<h1>Bonjour ' . $user['pseudo'] . ', vous êtes connecté</h1>';
         echo 'Pseudo : '. $user['pseudo'] . '<br>';
         echo 'MDP : '. $user['mdp'] . '<br>';
       } else {
        echo '<div style="background-color:red; color:white;text-align:center; padding: 20px;">Erreur sur le mot de passe ou le pseudo ! <br>Veuillez recommencer</div> ';
       }
     }
   ?>
</fieldset>
</div>
