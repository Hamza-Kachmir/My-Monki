<?php require_once('templates/header.php');
require_once "core/entity/config.php";
try {
    $connexion = new PDO($dsn, $dbuser, $dbpassword);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
$articles_blog = $connexion->query("SELECT * FROM article ORDER BY `article`.`date_creation` DESC limit 10");

?>

<main>
    <div class="container ">
        <section class="intro">
            <p>Bienvenue sur notre blog dédié aux singes ! Les primates ont toujours fasciné les êtres humains, que ce soit en raison de leur proximité génétique avec nous ou de leur intelligence exceptionnelle. Les singes sont également connus pour leur comportement social complexe et leur incroyable agilité.</p>
            <p>Notre blog est conçu pour vous offrir des informations complètes et intéressantes sur les différents types de singes, leur habitat naturel, leur comportement, leur régime alimentaire, leur reproduction et bien plus encore. Nous couvrons également l'actualité liée aux singes, les études scientifiques les plus récentes et les projets de conservation en cours pour protéger ces animaux incroyables.</p>
            <p>Que vous soyez un passionné de primates ou simplement curieux de découvrir l'univers des singes, notre blog est l'endroit idéal pour vous. Nous vous invitons à explorer nos articles et à partager vos commentaires et vos opinions avec notre communauté. Ensemble, nous pouvons en apprendre davantage sur ces animaux fascinants et contribuer à leur conservation.</p>
        </section>
        <?php while ($a = $articles_blog->fetch()) {
            $article_extrait = substr($a['contenu'], 0, 150);
        ?>
            <section>
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
            </section>
        <?php } ?>
    </div><!-- fin container -->
</main>

<?php require_once('templates/footer.php'); ?>