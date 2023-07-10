<?php
require_once('templates/header.php');
// stocker en base de données
require_once "core/entity/config.php";
try {
   $connexion = new PDO($dsn, $dbuser, $dbpassword);
} catch (PDOException $e) {
   die('Erreur : ' . $e->getMessage());
}
if (isset($_GET["s"]) and $_GET["s"] == "Rechercher") {
   $_GET["terme"] = htmlspecialchars($_GET["terme"]); //pour sécuriser le formulaire contre les failles html
   $terme = $_GET['terme'];
   $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
   $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
   if (isset($terme)) {
      $terme = strtolower($terme);
      $select_terme = $connexion->prepare("SELECT titre, contenu FROM article WHERE titre LIKE ? OR contenu LIKE ?");
      $select_terme->execute(array("%" . $terme . "%", "%" . $terme . "%"));
   } else {
      $message = "Vous devez entrer votre requete dans la barre de recherche";
   }
} ?>


<div class="container ">
   <section class="intro">
      <h2>Résultats de votre recherche</h2>
      <?php

      if ($select_terme->rowCount() > 0) {

         while ($terme_trouve = $select_terme->fetch()) {
            echo "<div><ul><li><h3>" . $terme_trouve['titre'] . "</h3><p> " . $terme_trouve['contenu'] . "</p></li></ul>";
         }
      } else { ?>
         Aucun résultat pour: <?= $terme ?>...
      <?php } ?>

   </section>
</div>