<?php 
require_once('templates/header.php'); 
    if (!empty($_POST)) {
        // Données postées depuis un formulaire !

        // Données obligatoire ici:
		// - email
        // - pseudo
        // - password
        if (isset($_POST["pseudo"]) && $_POST["pseudo"] != "" &&
            isset($_POST["password"]) && $_POST["password"] != "") {
			
			
            $pseudo = $_POST["pseudo"];
            $password = $_POST["password"];

            // stocker en base de données
            require_once "core/entity/config.php";

            // Connexion à la base de données
			$connexion = new PDO($dsn, $dbuser, $dbpassword);

            // Code SQL (= et non LIKE pour correspondance exacte ?)
            $sql = "SELECT * FROM utilisateur WHERE pseudo = :pseudo;";

            // PDO nous crée une requête préparée
            $query = $connexion-> prepare($sql);

            // Liaison des paramètres
            $query-> bindParam(":pseudo", $pseudo);
			
            // Execution de la requête
            if ($query-> execute()) {
                $result = $query-> fetch();
                // Vous pouvez analyser les résultats en décommentant la ligne suivante
                //var_dump($result);

                // Existe-t'il des correspondances entre l'username saisi
                // et des occurences (lignes) de la table users ?
                if ($result) {
                    if (password_verify($password, $result["hash_pwd"])) {
                        // Compte bien identifié, création de session
                        $succes = "Vous avez bien identifié, vous êtes maintenant connecté !";

                        // Afin de permettre de récupérer les données de l'utilisateur connecté, plus tard,
                        // il est important de stocker, au moins, son id unique dans une variable de session
                        $_SESSION["id"] = $result;

                        // Il est ensuite possible de rediriger l'utilisateur vers une page en particulier
                        // ou la page d'accueil avec la notation ./ :
                        header("Location: tableau-de-bord.php");
                        
                        exit;
                    } else {
                        // Le mot de passe saisi ne correspond pas au hash en base de données
                        // Ne pas donner trop d'infos au visiteur : silence is golden !
                        $erreur = "Vérifiez vos saisies !";
                    }
                } else {
                    // Aucune correpondance avec l'username saisi
                    // Ne pas donner trop d'infos au visiteur : silence is golden !
                    $erreur = "Vérifiez vos saisies !";
                }

            }
        } else {
            // Les champs obligatoires ne sont pas tous complétés
            //$alert = new Alert();
            $erreur = "Les champs obligatoires ne sont pas tous complétés !";
        }
    }
?>
<main>
<?php
        if (isset($erreur)) {
    ?>
        <div class="message">
            <?= $erreur; ?>
        </div>
    <?php
        }
    ?>

<?php
        if (isset($succes)) {
    ?>
        <div class="succes">
            <?= $succes; ?>
        </div>
    <?php
        }
    ?>
<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img-log"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Se connecter</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form method="post" action="" class="signin-form">
			      		<div class="form-group mt-3">
			      			<input type="text" name="pseudo" class="form-control" required>
			      			<label class="form-control-placeholder"  for="username">Pseudo</label>
			      		</div>
		            <div class="form-group">
		              <input id="password-field" type="password" name="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">Mot de passe</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-success rounded submit px-3">Se connecter</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-success mb-0">Se souvenir de moi
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
							</label>
						</div>
						<div class="w-50 text-md-right">
							<a href="#">Mot de passe oublié</a>
						</div>
		            </div>
		          </form>
		          <p class="text-center">Pas encore inscrit ? <a data-toggle="tab" href="formulaire-inscription.php">Créer un compte</a></p>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php require_once('templates/footer.php'); ?>