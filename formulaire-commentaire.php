<?php
/* Des données ont-elles été postées depuis un formulaire ? */
if (
	isset($_POST["commentaire"]) && $_POST["commentaire"] != ""

) {
	$contenu = ($_POST["commentaire"]);

	// Connexion à la base de données
	require_once "core/entity/config.php";
	// Chaîne de caractère pour stocker la requête SQL
	$sql = "INSERT INTO commentaire (comm) VALUES ('$contenu')";

	// Récuperation des données de connexion à la BDD

	try {

		// Connexion à la BDD
		$db = new PDO($dsn, $dbuser, $dbpassword);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Prèparation de la requête avec code SQL plus haut
		$query = $db->prepare($sql);

		// Execution de la requête sur la BDD
		if ($query->execute()) {
			$message = "<p> Le commentaire a bien été crée !</p>";
		} else {
			$message = "<p>Le commentaire n'a pas pu être créé !</p>";
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

?>
<main>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-12">
					<div class="wrap">
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Ajouter commentaire</h3>
								</div>
							</div>

							<form method="post" action="" class="signin-form">
								<textarea id="article-textarea" name="commentaire" placeholder="Rédiger votre commentaire"></textarea>
								<div class="form-group">
									<button type="submit" class="form-control btn btn-success rounded submit px-3">Soumettre</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>