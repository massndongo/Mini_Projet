<?php
session_start();
include_once "../traitement/fonctions.php";
$message="";
$role=""; 
if (isset($_POST['connexion'])) {
        $login=$_POST['login'];
        $mdp=$_POST['mdp'];
        if (empty($login) || empty($mdp)) {
            $message="Tous les champs sont obligatoires";
        }else {
                if (verif_info_connexion($login, $mdp)) {
                    $data = recup_info_user($login,$mdp);
                    foreach ($data as $value) { 
                            if ($value["role"]==="admin") { 
                                    $_SESSION['prenom']=$value['prenom'];
                                    $_SESSION['nom']=$value['nom'];
                                    $_SESSION['image']=$value['image'];
                                    $_SESSION['login']=$value['login'];
                                    $_SESSION['role']=$value['role'];
                                header('location:admin.php');
                            }else {
                                    $_SESSION['prenom']=$value['prenom'];
                                    $_SESSION['nom']=$value['nom'];
                                    $_SESSION['image']=$value['image'];
                                    $_SESSION['role']=$value['role'];
                                    $_SESSION['login']=$value['login'];
                                header('location:jeux.php');
                            }
                    }
                }else {
                       $message="Login ou mot de passe Incorrect";
                    }
            }
        }
 //session_destroy();   
?>
<html>
    <head>
        <title>PAGE DE CONNEXION</title>
        <meta charset=utf-8>
        <link rel="stylesheet" type="text/css" href="../public/css/connexion.css">
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
                <div class="entete-form">
                    <span id="login-form">Login Form</span>
                </div>
                <form action="" method="post">
                    <div class="input">
                        <span id="message" style="color:red"><?= isset($message) ? $message : '' ?></span>
                        <input type="text" name="login" id="inputlogin" placeholder="Login">
                        <span class="icone-input"><img src="../public/icones/ic-login.png" alt="" srcset=""></span>
                    </div>
                    <div class="input">
                        <input type="password" name="mdp" id="inputpsswd" placeholder="Password">
                        <span class="icone-input"><img src="../public/icones/ic-password.png" alt="" srcset=""></span>
                    </div>
                    <div class="submit">
                        <input type="submit" name="connexion" valueue="Connexion" id="sub">
                        <span class="lien-insc"><a href="inscriptionjoueur.php">S'inscrire pour jouer ?</a></span>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>