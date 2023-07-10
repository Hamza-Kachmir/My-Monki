<?php require_once('templates/header.php');
// stocker en base de données
require_once "core/entity/config.php";
try {
    $connexion = new PDO($dsn, $dbuser, $dbpassword);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

$articles_blog = $connexion->query("SELECT * FROM article");
?>
<?php while ($a = $articles_blog->fetch()) {
    $article_extrait = substr($a['contenu'], 0, 150);
?>

    <div class="container">
        <div class="card mb-3 max-width-540">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= './uploads/' . $a['pj'] ?>" class="card-image img-thumbnail" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><a href="article.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?></a></h5>
                        <em><?= $a['date_creation'] ?></em>
                        <p class="card-text"><?= $article_extrait; ?>...</p>
                        <a href="article.php?id=<?= $a['id'] ?>" class="btn btn-success">Lire la suite</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>





<?php require_once('templates/footer.php'); ?>