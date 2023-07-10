<?php
/* Des données ont-elles été postées depuis un formulaire ? */
if (
	// isset($_POST["titre-article"]) && $_POST["titre-article"] != "" &&
	// isset($_POST["contenu-article"]) && $_POST["contenu-article"] != ""
	(!empty($_POST) || !empty($_FILES)) 

) {
	$auteur = $_SESSION['id']['pseudo'];
	$idUtilisateur = $_SESSION['id']['id'];

	$titre= trim($_POST["titre-article"]);
	$contenu = ($_POST["contenu-article"]);
	$pj = ($_FILES["piece-jointe"]["tmp_name"]);

	var_dump($pj);
	$uploadedTempFile = $_FILES["piece-jointe"]["tmp_name"];
    $uploadDir = "uploads/";

		// Si le dossier uploads n'existe pas déjà, le créer
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir);
        }

		if (is_uploaded_file($uploadedTempFile)) {
            // Vérifier la taille du fichier uploadé (attention à la limite dans )
            if ($_FILES["piece-jointe"]["size"] < 1000000) {
                $mime_type = mime_content_type($uploadedTempFile);
    
                // Tableau contenant les types de fichier autorisés
                $allowed_mime_types = ["image/png", "image/jpeg", "application/pdf"];

                // Notre type est-il dans ce tableau ?
                if (in_array($mime_type, $allowed_mime_types)) {
                    $targetFile = $uploadDir . basename($_FILES["piece-jointe"]["name"]);
                    move_uploaded_file($uploadedTempFile, $targetFile);

                } else {
                    echo "Type de fichier non autorisé !";
                }
            }
        }

	
	

	// Connexion à la base de données

	// Chaîne de caractère pour stocker la requête SQL
	$sql = "INSERT INTO article (titre, contenu, id_utilisateur, pj) VALUES ('$titre', '$contenu', '$idUtilisateur', '$uploadedTempFile' )";

	// Récuperation des données de connexion à la BDD
	require_once "core/entity/config.php";
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
					
					<form method="post" action="" class="signin-form">
					<div class="form-group mt-3">
						<input class="form-control"type="text" name="titre-article" id="titre-article" placeholder="Titre article">
					</div>
					<div><p>Auteur : <?php echo $_SESSION['id']["pseudo"]?></p></div>		
					<textarea id="article-textarea" name="contenu-article" placeholder="Rédiger ici votre article"></textarea>
					<div class="mb-3">
						<label for="formFile" class="form-label">Ajouter une image</label>
						<input method="files" class="form-control" type="file" id="piece-jointe" name="piece-jointe" >
					</div>
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