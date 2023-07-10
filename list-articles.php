<?php
require_once "core/entity/config.php";

// Connexion à la base de données
$bdd = new PDO($dsn, $dbuser, $dbpassword);



if (isset($_GET['supprime']) and !empty($_GET['supprime'])) {
	$supprime = (int) $_GET['supprime'];

	$req = $bdd->prepare('DELETE FROM article = WHERE id = ?');
	$req->execute(array($supprime));
}

// Code SQL (= et non LIKE pour correspondance exacte ?)
$article = $bdd->query('SELECT * FROM article');

?>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-12">
				<div class="wrap">
					<!-- <div class="img-article"></div> -->
					<div class="login-wrap p-4 p-md-5">
						<div class="d-flex">
							<div class="w-100">
								<h3 class="mb-4">Liste des articles</h3>
							</div>
						</div>

						<ul>
							<?php
							while ($a = $article->fetch()) { ?>

								<li><?= $a['titre'] ?><?= $a['contenu'] ?><?php { ?> - <a href="list-articles.php?supprime<?= $a['id'] ?>">Supprimer</a></li>
							<?php } ?>

						<?php } ?>
						</ul>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>