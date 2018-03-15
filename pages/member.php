<?php
require_once '../inc/inc.php';

require_once "../inc/menu.php";
?>

<h1 class="align block_title">Index Page Membre</h1>
<a href="home.php"><i class="fas fa-home"></i></a>

<table>
  <thead>
   <tr>
    <th>Description</th>
    <th>Prix Enfant</th>
    <th>Prix Adulte</th>
    <th>Editer</th>
   </tr>
  </thead>

<?php $reponse = $bdd->query("SELECT description_avantage_cm, id_avantage_cm FROM avantage_cm" );
  while ( $reponse_tableau = $reponse->fetch(PDO::FETCH_ASSOC)) {
   echo "<tbody>";
   echo "<tr>";
    echo "<td>".$reponse_tableau["description_avantage_cm"]."</td>";
    echo "<td>"."<a href=\"member/edit.php?id=$reponse_tableau[id_avantage_cm]\"><i class='fas fa-edit'></i></a>"."</td>";;
   echo "</tr>";
    ?>

    <?php
      echo "</tbody>";
      echo "<table";
  }
?>
