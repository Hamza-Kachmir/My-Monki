<?php session_start();
    $id_session = session_id();
    
require_once "core/entity/config.php";
try{
    $connexion = new PDO($dsn, $dbuser, $dbpassword);
 }catch(PDOException $e){
    die('Erreur : '.$e->getMessage());
 }

 if(isset($_GET['id']) AND !empty($_GET['id'])){
    $get_id = htmlspecialchars(($_GET['id']));
    $article = $connexion->prepare('SELECT * FROM article WHERE id = ?');
    $article->execute(array($get_id));

    if($article->rowCount() == 1){
        $article = $article->fetch();
        $titre = $article['titre'];
        $contenu = $article['contenu'];
        $dateCreation = $article['date_creation'];
        $idAuteur = $article['id_utilisateur'];
        $imgArticle = $article['pj'];

        $auteur = $connexion->prepare('SELECT pseudo FROM utilisateur INNER JOIN article ON article.id_utilisateur=utilisateur.id;');
        $auteur->execute(array($get_id));
        $auteur = $auteur->fetch();
        $auteurArticle = $auteur['pseudo'];

    }

}


      else {
        die('cet article n\'existe pas !');
    }
    

 ?>

<!doctype html>

<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/qcrksd1tgqtcfxkf4awq7zpx3qdglvstharhktjlf3evo8d4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#article-textarea',
        menu: {
    file: { title: 'Fichier', items: 'newdocument restoredraft | preview | print ' },
    edit: { title: 'Edition', items: 'undo redo | cut copy paste | selectall | searchreplace' },
    view: { title: 'Affichage', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
    insert: { title: 'Insertion', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
    tools: { title: 'Outils', items: 'spellchecker spellcheckerlanguage | code wordcount' },
    table: { title: 'Tableau', items: 'inserttable | cell row column | tableprops deletetable' },
    help: { title: 'Aide', items: 'help' }
  }
      });
    </script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="public/css/tdb.css">
    <title>Article</title>
  </head>
  <body><nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img class="logo-nav" src="public/assets/img/logo-monki.png"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="blog.php">Blog</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="login.php">Connexion</a>
              </li>
            </ul>

            <form class="d-flex" action = "verif-form.php" method = "get">
            <input class="form-control me-2" type = "search" name = "terme">
            <input class="btn btn-outline-success" type = "submit" name = "s" value = "Rechercher">
            </form>
          </div>
        </div>
      </nav>
    <header>
      <h1>My Monki, le seul blog pour tout savoir sur les singes ! </h1>
    </header>
<main>

<div class="container">
          
          <section class="section">
          <div class="col-12">
                <div class="card">
                    <img src="<?= './uploads/' . $imgArticle ?>" class="card-img-top" alt="New York">
                    <div class="card-body">
                        <h5 class="card-title"><?= $titre ?></h5>
                        <em><?= $dateCreation . ' ' . $auteurArticle?></em>
                        <p class="card-text"><?= $contenu ?></p>
                    </div>
                    <a href="blog.php" class="btn btn-success">retour</a>
                </div>
            </div>
        </section>

        <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-12">
					<div class="wrap">
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
                <div><p>Auteur : <?php echo $_SESSION['id']["pseudo"]?></p></div>
			      			<h3 class="mb-4">Ajouter commentaire</h3>
			      		</div>
			      	</div>
					
					<form method="post" action="" class="signin-form">
					<textarea id="article-textarea" name="commentaire" placeholder="Rédiger votre commentaire"></textarea>
					<div class="form-group">
          <input class="btn btn-outline-success" type = "submit" name = "s-c" value = "Poster mon commentaire">
          <?php if(isset($com_erreur)) { echo "Erreur : ".$com_erreur; } ?>
						
					</div>
					</form>
		      
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
    </div>

    </main>

    <?php
  
    require_once('templates/footer.php'); ?>
    <!-- https://www.youtube.com/watch?v=GDOJCCAZYfw -->