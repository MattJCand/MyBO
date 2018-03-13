<?php 
require_once "../../inc/menu_2.php";


?>
<main>
  <h1 class="align">Ajouter une actualité</h1>

<a href="../home.php"><i class="fas fa-home"></i></a>



  <form method="post" action="#">

    <input name="titre" type="text"  placeholder="titre actu" value="<?php  $titre;?>">

    <input name="description" type="text"  placeholder="description" value="<?php $description;?>">

    <input name="url" type="text"  placeholder="url evenement" value="<?php $url;?>">

    <input type="submit" name="submit" value="submit">

  </form>

</main>

