<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('location: connexion.php');
    exit;
}
$data=file_get_contents(dirname(__DIR__).'/data/users.json');
$data=json_decode($data,true);
foreach ($data as $value) { 
        if ($value['role']== "joueur") {
            $infosJoueurs[]=$value;
        }
}
foreach ($infosJoueurs as $value) {
    if (isset($_SESSION['login']) && isset($value['login']) && $_SESSION['login']==$value['login']) {
        $score=$value['score'];
    }
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
                        <div class="link-score">
                            <a href='jeux.php?lien=top' class="lks"><div class="best-score">Top scores</div></a>
                            <a href='jeux.php?lien=montop' class="lks"><div class="best-score">Mon meilleur score</div></a>
                        </div>
                        <div class="affichage">
                            <?php 
                                if (isset($_GET['lien'])) {
                                    if ($_GET['lien']=='top') {
                                        $columns=array_column($infosJoueurs, 'score');
                                        array_multisort($columns, SORT_DESC, $infosJoueurs);
                                        $i=0;
                                        foreach ($infosJoueurs as  $value) {
                                            echo $value['prenom']." ".$value['nom']."<span style='float:right;margin-right:10px'>".$value['score']."pts</span><br>";
                                            $i++;
                                            if ($i==5) {
                                            break;
                                            }
                                        }
                                    }else {
                                        if ($_GET['lien']=='montop') {
                                            echo $_SESSION['prenom']." ".$_SESSION['nom']."<span style='float:right;margin-right:10px'>".$score."pts</span>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>