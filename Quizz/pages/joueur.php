<?php
session_start();
//session_destroy();   
if (!isset($_SESSION['role'])) {
    header('location: connexion.php');
    exit;
}
?>
<html>
    <head>
        <title>PAGE ADMIN</title>
        <meta charset=utf-8>
        <link rel="stylesheet" type="text/css" href="../public/css/joueur.css">
    </head>
    <body>
        <div class="background-green">
            <div class="quizz">
                <a href="#"><img src="../public/images/logo-QuizzSA.png" alt="Erreur"></a>
            </div>
            <h2 id="titre">Le plaisir de jouer</h2>
        </div>
        <div class="arriere-plan">
            <div class="conteneur">
                <div class="entete">
                    <div class="image">
                        <div class="pp"><img src="<?= $_SESSION['image'] ?>" alt="" srcset=""></div>
                        <span id="prenom"><?= $_SESSION['prenom'] ?></span>
                        <span id="nom"><?= $_SESSION['nom'] ?></span>
                    </div>
                    <div class="text">
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br></span>
                        <span>JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERAL</span> 
                    </div>
                    <div class="class-deconnexion">
                        <a href="deconnexion.php" id="deconnexion">Déconnexion</a>
                    </div>
                </div>
                <div class="conteneur-body">
                    <div class="question">

                    </div>
                    <div class="score">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>