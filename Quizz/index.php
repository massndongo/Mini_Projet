<?php
session_start();
?>
<!Doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="public/css/quizz.css">
    <title>Quizz</title>
</head>
<body>
    <div class="header">
        <div class="logo"></div>
        <div class="header-text">Le plaisir de Jouer</div>
    </div>
    <div class="content">
        <?php
            require_once('pages/connexion.php');

            if (isset($_GET['lien'])) {
                switch ($_GET['lien']) {
                    case 'accueil':
                        require_once('pages/pageadmin.php');
                        break;
                    case 'jeux':
                        require_once('pages/joueur.php');
                        break;
                }
            }else {
                if (isset($_GET['statut']) && $_GET['statut']==="logout") {
                    deconnexion();
                }
                require_once('pages/connexion.php');
            }

            require_once('traitement/fonctions.php');
        ?>
    </div>
</body>