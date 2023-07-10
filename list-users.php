<?php
require_once "core/entity/config.php";

// Connexion à la base de données
$bdd = new PDO($dsn, $dbuser, $dbpassword);

// if(!in_array($_SESSION['role'], ['Administrateur'])) {
// 	header('Location: /');
// 	exit;
// }

if (isset($_GET['supprime']) and !empty($_GET['supprime'])) {
	$supprime = (int) $_GET['supprime'];

	$req = $bdd->prepare('DELETE FROM utilisateur = WHERE id = ?');
	$req->execute(array($supprime));
}


// Code SQL (= et non LIKE pour correspondance exacte ?)
$utilisateur = $bdd->query('SELECT * FROM utilisateur');

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
								<h3 class="mb-4">Liste des utilisateurs</h3>
							</div>
						</div>

						<ul>
							<?php
							while ($u = $utilisateur->fetch()) { ?>

								<li><?= $u['pseudo'] ?><?php { ?> - <button <?= $u['id'] ?>>Supprimer</button></li>
								<select name="role" id="">
									<option value="<?= $u['role'] ?>" hidden><?= $u['role'] ?></option>
								</select>
								<select name="activation" id="">
									<option value="" hidden><?= $u['activation'] ?></option>
								</select>

							<?php } ?>

						<?php } ?>
						</ul>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>