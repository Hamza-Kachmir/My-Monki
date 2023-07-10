<?php
require_once('templates/header.php');
/* Des données ont-elles été postées depuis un formulaire ? */

if (!empty($_POST)) {
	// Données postées depuis un formulaire !

	// Données obligatoire ici:
	// - username
	// - password
	// - password-confirm
	// - email
	if (
		isset($_POST["email"]) && $_POST["email"] != "" &&
		isset($_POST["pseudo"]) && $_POST["pseudo"] != "" &&
		isset($_POST["password"]) && $_POST["password"] != "" &&
		isset($_POST["confpassword"]) && $_POST["confpassword"] != "" &&
		isset($_POST["ville"]) && $_POST["ville"] != ""


	) {
		// Les deux mots de passe se correspondent-ils ?
		if ($_POST["password"] == $_POST["confpassword"]) {

			// Vérification de la longueur en caractères du mot de passe (8 minimum)
			if (strlen($_POST["password"]) > 8) {
				$email =  $_POST["email"];
				$pseudo = $_POST["pseudo"];
				$password = $_POST["password"];
				$ville = $_POST["ville"];
				$pays = $_POST["pays"];

				// Coût du hachage (temps processeur, etc.)
				$options = [
					"cost" => 12
				];
				$hash = password_hash($_POST["password"], PASSWORD_DEFAULT, $options);

				// stocker en base de données
				require_once "core/entity/config.php";

				// Connexion à la base de données
				$connexion = new PDO($dsn, $dbuser, $dbpassword);

				// Code SQL
				$sql = "INSERT INTO utilisateur (pseudo, hash_pwd, email, ville, pays) VALUES (:pseudo, :hash, :email, :ville, :pays);";

				// PDO nous crée une requête préparée
				$query = $connexion->prepare($sql);

				// Liaison des paramètres
				$query->bindParam(":email", $email);
				$query->bindParam(":pseudo", $pseudo);
				$query->bindParam(":hash", $hash);
				$query->bindParam(":ville", $ville);
				$query->bindParam(":pays", $pays);

				// Execution de la requête
				$query->execute();
			} else {
				// Mot de passe trop court
				$erreur = "Le mot de passe saisi est trop court: 8 caractères au minimum";
			}
		} else {
			// Les mots de passes ne se correspondent pas
			$erreur = "Les mots de passes ne se correspondent pas";
		}
	} else {
		// Les champs obligatoires ne sont pas tous complétés
		//$alert = new Alert();
		$erreur = "Les champs obligatoires ne sont pas tous complétés";
	}
}
?>

<?php if (isset($erreur)) { ?>
	<p><?= $erreur; ?></p>
<?php } ?>


<main>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img-create"></div>
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Créer un compte</h3>
								</div>
							</div>

							<form method="post" action="" class="signin-form">

								<div class="form-group mt-3">
									<input class="form-control" type="email" name="email" id="email" placeholder="Mail*" required>
								</div>

								<div class="form-group mt-3">
									<input class="form-control" type="text" name="pseudo" id="pseudo" placeholder="Pseudo*" required>
								</div>
								<div class="form-group mt-3">
									<input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe*" required>
								</div>
								<div class="form-group mt-3">
									<input class="form-control" type="password" name="confpassword" id="confpassword" placeholder="Confirmer le mot de passe*" required>
								</div>

								<div class="form-group mt-3">
									<input class="form-control" type="text" name="ville" id="ville" placeholder="Ville*">
								</div>
								<div class="form-group mt-3">
									<input class="form-control" type="text" name="pays" id="pays" placeholder="Pays">
								</div>

								<div class="form-group">
									<button type="submit" class="form-control btn btn-success rounded submit px-3">S'inscrire</button>
								</div>
							</form>
							<p class="text-center">Déjà inscrit ? <a data-toggle="tab" href="login.php">Se connecter</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require_once('templates/footer.php'); ?>