<?php
include_once ('../traitement/fonctions.php');
session_start();
if (empty($_SESSION['start'])) {
    $_SESSION['start'] = 1;
}
if (!isset($_SESSION['role'])) {
    header('location: connexion.php');
    exit;
}
$data=getData($file="users");
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
$questions=getData($file="questions");
if ($_SESSION['start']==1) {
    $questions=shuffle($questions);
    $_SESSION['start']=2;
}
$nbr=getData($file="parametre");
$nb=$nbr['nbr'];
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
                        <div class="pp"><img src="<?= $_SESSION['image'] ?>"></div>
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
                        <form action="" method="post">
                            <?php
                                $tabRep=[];
                                if (isset($_POST['suivant'])) {
                                    $debut=$_SESSION['fin'];
                                    $fin=$_SESSION['fin']+1;
                                }elseif (isset($_POST['precedent'])) {
                                    $debut=$_SESSION['fin']-2;
                                    $fin=$_SESSION['fin']-1;
                                }else {
                                    $debut=0;
                                    $fin=1;
                                }
                                if ($_SESSION['start']==1) {
                                    shuffle($questions);
                                    $_SESSION['start'] = 2;
                                }
                                for ($i=$debut; $i < $fin ; $i++) {
                                    if (isset($nb) && $i<$nb) {
                                        if($questions[$i]["choixReponse"]=="choixM"){  ?>
                                           <div class="question-jeu"><p style="padding-top:10px">Questions <?= ($i+1).'/'.$nb.'<br>' ?></p><span  style='font-size: 20px;'><?= $questions[$i]["question"]?></span></div>
                                           <div class="question-score"><?= $questions[$i]["point"]."pts" ?></div> 
                                           <?php 
                                            foreach ($questions[$i]["reponse"] as $rep) { 
                                                foreach ($rep as $reponse) {?>
                                                    <div class="reponse"><input type='checkbox' name="box[]" <?php if(isset($_POST['box'])) { echo 'checked="checked"';} ?> class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:lighter'><?= $reponse ?></span><br></div>
                                            <?php
                                                } 
                                            }
                                        }
                                        elseif($questions[$i]["choixReponse"]=="choixS"){ ?>
                                            <div class="question-jeu"><p style="padding-top:10px">Questions <?= ($i+1).'/'.$nb.'<br>' ?></p><span style='font-size: 20px;  '><?=  $questions[$i]["question"]?></span></div>
                                           <div class="question-score"><?= $questions[$i]["point"]."pts" ?></div> 
                                            <?php foreach ($questions[$i]["reponse"] as $rep) { 
                                                    foreach ($rep as $reponse) { ?>
                                                        <div class="reponse"><input type='radio' name='radio_'$i class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:lighter'><?= $reponse ?></span><br></div>
                                            <?php }
                                                }
                                        }
                                        else{ 
                                             ?>
                                           <div class="question-jeu"><p style="padding-top:10px">Questions <?= ($i+1).'/'.$nb.'<br>' ?></p><span style='font-size: 20px;font-weight:lighter  '><?=  $questions[$i]["question"] ?></span></div>
                                           <div class="question-score"><?= $questions[$i]["point"]."pts" ?></div> 
                                           <div class="reponse"><input type='text' style='background-color:#f7f7f7;height:25px;width:80%;position:absolute;left:45px;'><br></div>
                                        <?php }
                                    }
                                }
                                if (isset($_POST['box'])) {
                                    $tabRep[]=$reponse;
                                }var_dump($tabRep);
                        $_SESSION['fin']=$fin;
                            ?>
                        </div>
                        <div class="suivant" style="width:100%;margin:auto;position:relative;top:450px;right:500px;">
                         <?php
                            if (isset($_POST['suivant']) || $_SESSION['fin']>1) {  ?>
                                <button name="precedent" style="float:left; position:relative;right:60px;width:15%;height:7%">Precedent</button>
                                <?php } else { ?>
                                <button  disabled='disabled' name="precedent" style="background-color:#818181;float:left; position:relative;right:60px;width:15%;height:7%">Precedent</button>
                                    
                                <?php }
                            if ($_SESSION['fin']<$nb) { ?>
                             <button name='suivant' style='float:right;position:relative;left:150px;width:15%;height:7%'>Suivant</button>

                                 <?php }else { ?>
                             <button  name='finish' style='background-color:#818181;float:right;position:relative;left:150px;width:15%;height:7%'>Terminé</button>
                                     
                                 <?php } ?>
                        </div>
                        <?php 
                            if (isset($_POST['box']) ) {
                                
                            }
                        ?>
                        </form>
                    </div>
                    <div class="score">
                        <div class="link-score">
                            <a href='jeux.php?lien=top' class="lks"><div class="best-score">Top scores</div></a>
                            <a href='jeux.php?lien=montop' class="lks"><div class="best-score" style="float:right;position:relative;bottom:21px;">Mon meilleur score</div></a>
                        </div>
                        <div class="affichage" style="font-size: 25px;">
                            <?php 
                                if (isset($_GET['lien'])) {
                                    if ($_GET['lien']=='top') {
                                        $columns=array_column($infosJoueurs, 'score');
                                        array_multisort($columns, SORT_DESC, $infosJoueurs);
                                        $i=0;
                                        foreach ($infosJoueurs as  $value) {
                                            echo $value['prenom']." ".$value['nom']."<span style='float:right;margin-right:10px'>".$value['score']."pts<hr style='background-color:red;height:1px'></span><br><br>";
                                            $i++;
                                            if ($i==5) {
                                            break;
                                            }
                                        }
                                    }else {
                                        if ($_GET['lien']=='montop') {
                                            echo $_SESSION['prenom']." ".$_SESSION['nom']."<span style='float:right;margin-right:10px'>".$score."pts<hr style='background-color:red;height:1px'></span><br><br>";
                                        }
                                    }
                                }else{
                                    echo $_SESSION['prenom']." ".$_SESSION['nom']."<span style='float:right;margin-right:10px'>".$score."pts</span><br><br>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>