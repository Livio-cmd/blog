<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./css/content-style.css">
    <script src="https://kit.fontawesome.com/f8e2c06346.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./aos.css">
    <script src="./script.js" defer></script>
    <script src="./ckeditor5-build-classic-33.0.0/ckeditor5-build-classic/ckeditor.js"></script>

</head>

<body>
    <nav id="navbar">
        <h2 class="website-title">Livio</h2>
        <hr class="small">
        <p>Salut, je suis livio et j'ai créé ce petit <strong>BLOG</strong> pour m'entrainer au code
            <strong>fullstack</strong>.</p>
        <hr class="small">
        <ul>
            <li><a href="#" style="color: #000;">Accueil</a></li>
            <li><a href="#">about</a></li>
            <li><a href="./createur.php">Créer</a></li>
        </ul>
        <hr class="small">
        <div class="row">
            <a href="#"><i class="fa-brands fa-facebook-square"></i></a>
            <a href="#"><i class="fa-brands fa-instagram-square"></i></a>
            <a href="#"><i class="fa-brands fa-twitter-square"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            <a href="#"><i class="fa-solid fa-envelope"></i></a>
        </div>
    </nav>
    <div id="phone-nav">
        <div id="navcheck"><i class="fa-solid fa-bars"></i></div>
    </div>
    <div class="content-wrapper">
        <?php
        include('./database.php');
        $q = $db->prepare('SELECT * FROM `post` WHERE 1');
        $q->execute();
        $result = $q->fetchAll();

    if(count($result) > 0){
        foreach(array_reverse($result) as $postData){
            ?>
        <div class="listitem fade-up ck-content">
            <a href="./contenu.php?id=<?= $postData['id'] ?>" class="blog-image"><img
                    src="data:image/jpeg;base64, <?php echo base64_encode($postData['image']) ?>"
                    alt="Image de l'article"></a>
            <div class="post-content">
                <a style="color:#333;" href="./contenu.php?id=<?= $postData['id'] ?>" class="blog-title-link">
                    <?= $postData['title'] ;?>
                </a>
                <p>&nbsp;</p>
                <p class="content">
                    <?= substr($postData['content'], 0, 500).' ...'?>
                    <a href="./contenu.php?id=<?= $postData['id'] ?>" class="read-more-link" style="color:#aaa;">Read
                        more</a>
                </p>

                <div class="row">
                    <div class="post-info">
                        <?= substr(str_replace('-','/', $postData['date']), 0, 10)?>
                    </div>
                    <div class="post-info-separator"><strong>|</strong></div>
                    <div class="post-info"><a href="#" style="font-size: 10px; font-weight: 400;color:#aaa;">
                            <?= $postData['type'] ?>
                        </a></div>
                </div>
            </div>
        </div>
        <?php
        }
    }else {
        ?>
        <div class="listitem fade-up">
            <div class="post-content">
                <div class="col" style="align-items: flex-start;">
                    <a style="color: #333;" href="#" class="blog-title-link">Pas de publication pour le moment</a>
                    <a style="margin-top: 15px;" href="./createur.php" class="button">Créer une publication</a>
                </div>
                <p class="post-summary">Pour le moment aucune publications n'est disponible. Peut être un problème de
                    serveur ou bien personne n'a écris ici ?</p>
                <div class="row">
                    <div class="post-info">DATE</div>
                    <div class="post-info-separator"><strong>|</strong></div>
                    <div class="post-info"><a href="#" style="font-size: 10px; font-weight: 400;color:#aaa;">TYPE</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
?>
        <div class="col btm-btn">
            <a href="#" class="button">All Posts →</a>
            <a href="./createur.php" class="button">créer</a>
        </div>
    </div>
    </div>
    
</body>
</html>