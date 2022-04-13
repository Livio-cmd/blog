<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
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
            <li><a href="./index.php">Accueil</a></li>
            <li><a href="#">about</a></li>
            <li><a style="color: #000;" href="./createur.php">Créer</a></li>
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
    <?php
        include('./database.php');
        extract($_POST);

        if(isset($send)){
            if(!empty($title) && !empty($editor) && !empty($type)){
                // $data = $_POST['editor'];
                // $dom = new DOMDocument;
                // $dom -> loadHTML ($data);

                $q = $db->prepare('INSERT INTO `post`(`image`, `title`, `content`, `type`) VALUES (:image, :title, :content, :type)');
                try{
                    if(empty($_FILES['image']['tmp_name'])){
                        $q->execute([
                            'image' => file_get_contents('./default.jpg'),
                            'title' => $title,
                            'content' => $content,
                            'type' => $type
                        ]);
                    }
                    else {
                        $q->execute([
                            'image' => file_get_contents($_FILES['image']['tmp_name']),
                            'title' => $title,
                            'content' => $editor,
                            'type' => $type
                        ]);
                    }
                }catch(PDOException $error){
                    ?>
    <div class="content-wrapper">
        <?php echo $error->getMessage(); ?>
    </div>
    <?php
                }
            }else {
                echo 'Veuillez remplir tous les champs';
            }
        }
    ?>
    <div class="content-wrapper">
        <div class="container">
            <form method="POST" enctype="multipart/form-data">
                <div class="col">
                    <h2>Image <span>2MB max</span></h2>
                    <a style="margin-top: 10px;" href="#">Reduir le poids de l'image ?</a>
                    <input type="file" name="image" id="image" accept="image/*" required>
                    <h2>Titre</h2>
                    <input type="text" name="title" id="title" placeholder="Ex: Bivouac en solo (180 caractèrs max)"
                        autocomplete="off" maxlength="180" required>
                    <h2>Type de contenu</h2>
                    <input type="text" name="type" id="type" maxlength="15" placeholder="Ex: nature (15 caractèrs max)"
                        required>
                    <h2>Contenu de l'article</h2>
                    <textarea style="max-height: 500px;overflow-y: scroll;" class="ck-content" name="editor" id="editor"
                        maxlength="5000"></textarea>
                    <h2>Valider</h2>
                    <input type="submit" value="publier" class="button" name='send'>
                    <a href="./index.php" class="button">Retour</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>