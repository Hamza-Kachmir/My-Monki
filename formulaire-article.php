<?php

/* Des données ont-elles été postées depuis un formulaire ? */
if (
	isset($_POST["titre-article"]) && $_POST["titre-article"] != "" &&
	isset($_POST["contenu-article"]) && $_POST["contenu-article"] != "" &&
	isset($_FILES['file'])

) {
	$titre = trim($_POST["titre-article"]);
	$contenu = ($_POST["contenu-article"]);
	$auteur = $_SESSION['id']['pseudo'];
	$idUtilisateur = $_SESSION['id']['id'];

	$tmpName = $_FILES['file']['tmp_name'];
	$name = $_FILES['file']['name'];
	$size = $_FILES['file']['size'];
	$error = $_FILES['file']['error'];

	move_uploaded_file($tmpName, './uploads/' . $name);
	// if($stockagePj) {
	// 	echo 'Image envoyée avec succès !';

	// } else {
	// 	echo 'Une erreur est survenue !';
	// }

	require_once "core/entity/config.php";
	// Connexion à la base de données

	// Chaîne de caractère pour stocker la requête SQL
	$sql = "INSERT INTO article (titre, contenu, id_utilisateur, pj) VALUES ('$titre', '$contenu', '$idUtilisateur', '$name')";

	// Récuperation des données de connexion à la BDD

	try {

		// Connexion à la BDD
		$db = new PDO($dsn, $dbuser, $dbpassword);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Prèparation de la requête avec code SQL plus haut
		$query = $db->prepare($sql);

		// Execution de la requête sur la BDD
		if ($query->execute()) {
			$message = "<p> L'article a bien été crée !</p>";
		} else {
			$message = "<p>L'article n'a pas pu être créé !</p>";
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
						<!-- <div class="img-article"></div> -->
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Ajouter un article</h3>
								</div>
							</div>

							<form method="post" action="" class="signin-form" enctype="multipart/form-data">
								<div class="form-group mt-3">
									<input class="form-control" type="text" name="titre-article" id="titre-article" placeholder="Titre article">
								</div>
								<div>
									<p>Auteur : <?php echo $_SESSION['id']["pseudo"] ?></p>
								</div>
								<textarea id="article-textarea" name="contenu-article" placeholder="Rédiger ici votre article"></textarea>
								<div class="mb-3">
									<label for="formFile" class="form-label">Ajouter une image</label>
									<input class="form-control" type="file" id="file" name="file">
								</div>
								<div class="form-group">
									<button type="submit" name="envoyer" class="form-control btn btn-success rounded submit px-3">Soumettre</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>