<?php
session_start();
//session_destroy(); 
if (!isset($_SESSION['role'])) {
    header('location: connexion.php');
    exit;
}

?>

<script type="text/javascript"><!--
$(#monImage).attr(src, '../public/icones/ic-liste-active.png');
$('#monImage').on({
    'click':function () {
        var src=($(this).attr('src') === '../public/icones/ic-liste.png') ?
        '../public/icones/ic-liste-active.png')
        : '../public/icones/ic-liste.png';
        $(this.attr('src, src'));
    };
})
$(document).ready(function () {  

  $("a.load")
  .click(function() {
  $("#myid").load(this.href);
    return false;
  });

  $("a.load")
  .each(function(i){
    $(this)
   .href(this.href.replace("mapage", "mapage_fragment"))
  });

});
// --></script>

<html>
    <head>
        <title>PAGE ADMIN</title>
        <meta charset=utf-8>
        <link rel="stylesheet" type="text/css" href="../public/css/pageadmin.css">
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
                    <span id="texte">CREER ET PARAMETRER VOS QUIZZ</span>
                    <div class="class-lien-decinnexion">
                        <a href="deconnexion.php" id="deconnexion">Déconnexion</a>
                    </div>
                </div>
                <div class="petite-section" >
                    <div class="info-user">
                        <div class="pp">
                            <img src="<?= $_SESSION['image'] ?>" alt="" srcset="">
                        </div>
                        <div class="filiale">
                            <p id="prenom"><?= $_SESSION['prenom'] ?></p>
                            <p id="nom"><?= $_SESSION['nom'] ?></p>
                        </div>
                    </div>
                    <div class="list-prop">
                        <ul>
                            <div class="li"><a href="admin.php?lien=lq"><li><span class="text">Liste Questions</span><span class="icn"><img src="../public/icones/ic-liste.png" id="monImage" alt="" srcset=""></span></li></a></div>
                            <div class="li"><a href="admin.php?lien=ca" ><li><span class="text">Créer Admin</span><span class="icn"><img src="../public/icones/ic-ajout.png" alt="" srcset=""  ></span></li></a></div>
                            <div class="li"><a href="admin.php?lien=lj"><li><span class="text">Liste Joueurs</span><span class="icn"><img src="../public/icones/ic-liste.png" alt="" srcset=""  ></span></li></a></div>
                            <div class="li"><a href="admin.php?lien=cq"><li><span class="text">Créer Questions</span><span class="icn"><img src="../public/icones/ic-ajout.png" alt="" srcset=""  ></span></li></a></div>
                            <div class="li"><a href="admin.php?lien=bord"><li><span class="text">Tableau de bord</span><span class="icn"><img src="../public/icones/ic-liste.png" alt="" srcset=""  ></span></li></a></div>
                        </ul>
                    </div>
                </div>
                <div class="grande-section" id="myid">
                    <?php
                        if (isset($_GET['lien'])) {
                            if ($_GET['lien']=='lq') {
                                require_once "listequestion.php";
                            }elseif ($_GET['lien']=='ca') {
                                require_once "inscription.php";
                            }elseif ($_GET['lien']=='lj') {
                                require_once "listejoueur.php";
                            }elseif ($_GET['lien']=='cq') {
                                require_once "question.php";
                            }elseif ($_GET['lien']=='bord') {
                                require_once "dashboard.php";
                            }
                        }else {
                            require_once "listejoueur.php";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>