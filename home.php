<?php include "templates/header.php"; ?>
<?php include "admin/session.php"; ?>

<div class="align homeLogo">
  <img src="asset/img/logo_final.png" alt="logo Planete Manga">
  <h1 class="align"> Accueil Back Office </h1>
  <a href="admin/logout.php">Deconnexion</a>
</div>


<section id="sectionPages">
  <div class="container">
    <a href="accueil.php"><div id="accueil"></div></a>
    <a href="galerie.php"><div id="galerie"></div></a>
    <a href="about.php"><div id="about"></div></a>
  </div>
  <div class="container">
    <a href="partner.php"><div id="partner"></div></a>
    <a href="manga.php"><div id="manga"></div></a>
    <a href="draw.php"><div id="dessin"></div></a>
  </div>
   <div class="container">
    <a href="japan.php"><div id="japonais"></div></a>
    <a href="member.php"><div id="member"></div></a>
    <a href="actu.php"><div id="actu"></div></a>
  </div>
   <div class="container">
    <a href="event.php"><div id="event"></div></a>
    <a href="contact.php"><div id="contact"></div></a>
    <a href="#"><div id="press"></div></a>
  </div>
</section>


<?php include "templates/footer.php"; ?>
