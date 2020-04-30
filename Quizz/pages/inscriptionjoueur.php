<?php
    $message="";
    $msg="";
    if (isset($_POST['btn'])) {
        $prenom=$_POST['prenom'];
        $nom=$_POST['nom'];
        $pwd1=$_POST['pwd1'];
        $pwd2=$_POST['pwd2'];
        $file=$_POST['file'];
        if (isset($_POST['login'])) {   
            $login=$_POST['login'];
            $data=file_get_contents(dirname(__DIR__).'/data/users.json');
            $data=json_decode($data,true);
            foreach ($data as $value) {
                if($login===$value["role"]){
                    $message="Ce login existe!!!";
                }else {
                   if ($pwd1==$pwd2) {
                       $msg="";
                            if (file_exists(dirname(__DIR__).'/data/users.json')) {
                                $extrait=array(
                                "prenom" => $_POST['prenom'],
                                "nom" => $_POST['nom'],
                                "login" => $_POST['login'],
                                "mdp" => $_POST['pwd1'],
                                "image" => $_POST['file'],
                                "role" => "joueur",
                                "score" => 0
    
                            );
                            array_push($data,$extrait);
                            $final_data=json_encode($data,true);
                                if (file_put_contents(dirname(__DIR__).'/data/users.json', $final_data)) {
                                    header('location: connexion.php');
                                }
                            }else {
                                $error="Fichier JSON inexistant!!";
                            }
                    }else {
                        $msg="Mot de pass doit etre indentique";
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/inscriptionjoueur.css">
    <title>Inscription</title>
    <script type='text/javascript'>
    function load_image(avatar) {
        let image = document.getElementById('img');
        image.src = window.URL.createObjectURL(avatar.files[0])
     }
    </script>
</head>
<body>
    <div class="background-green" style="height: 85px;">
        <div class="quizz" style="width: 6%;">
            <a href="#"><img src="../public/images/logo-QuizzSA.png" alt="Erreur"></a>
        </div>
        <h2 id="titre">Le plaisir de jouer</h2>
    </div>
    <h3>S'INSCRIRE</h3>
    <p>Pour testervotre nveau de culture générale</p>
    <hr>
    <form method="post" id="myform">
        <div class="form-controle">
        <input type="number" name="score" hidden="hidden" id="">
            <label for="" class="label">Prénom</label>
            <input type="text" class="input-form" error="error-1" name="prenom" id="">
            <div class="error-form" id="error-1"></div>
        </div>
        <div class="form-controle">
            <label for="" class="label">Nom</label>
            <input type="text" error="error-2" class="input-form" name="nom" id="">
            <div class="error-form" id="error-2"></div>
        </div>
        <div class="form-controle">
            <label for="" class="label">Login</label>
            <input type="text" error="error-3"  class="input-form" name="login" id="login">
            <div class="error-form" id="error-3"><?= isset($message) ? $message : "" ?></div>
        </div>
        <div class="form-controle">
            <label for="" class="label">Password</label>
            <input type="password" error="error-4" class="input-form" name="pwd1" id="">
            <div class="error-form" id="error-4"></div>
        </div>
        <div class="form-controle">
            <label for="" class="label">Confirmer Password</label>
            <input type="password" error="error-5" class="input-form" name="pwd2" id="">
            <div class="error-form" id="error-5"><?= isset($msg) ? $msg : "" ?></div>
        </div>
        <div class="form-controle" id="div-avatar">
            <label for="" class="avatar-text">Avatar</label>
            <label class="btn-file">Choisir un fichier</label>
            <input type="file" style="opacity:0" accept="image/jpeg, image/png" onchange="load_image(this)" name="file" id="fichier">
        </div>
        <div class="form-controle">
            <input type="submit" value="Créer compte" class="btn-submit" name="btn" id="">
        </div>
        <div class="avatar-img" style="position: absolute;left: 60%;bottom: 15%;"><img src="" style="width:100%;height:100%; border-radius:60%" id="img" alt=""></div>
        <label for="" id="avatar-texte" style="position: absolute;left: 65%; bottom: 10%;">Avatar du Joueur</label>
    </form>
    
<script>
const inputs=document.getElementsByTagName("input");
for(input of inputs){
   input.addEventListener("keyup", function (e) {
     if(e.target.hasAttribute("error")) {
         var idDivError=e.target.getAttribute("error")
         document.getElementById(idDivError).innerText=""
     }
   })
}

document.getElementById("myform").addEventListener("submit", function(e){
const inputs=document.getElementsByTagName("input");
    var error=false;
    for(input of inputs){
        if (input.hasAttribute("error")) {
            var idDivError=input.getAttribute("error");
            if (!(input.value)) {
                error=true;
                document.getElementById(idDivError).innerText="Ce champ est obligatoire";
            }else{
                pwd1=document.getElementById('pwd1').value
                pwd2=document.getElementById('pwd2').value
                if(pwd1!=pwd2){
                    document.getElementById('error-5').innerText="Mot de pass doit etre identique"
                }
            } 
        }
    }
    if (error) {
        e.preventDefault();
        return false;
    }
    
})
//$.get(dirname(__DIR__).'/data/users.json'), function (data) {
  //  if (data[0]["login"]===document.getElementById('login')) {
    //    document.getElementById(idDivError).innerText="Ce login existe déjà!!";
    //}
//})
</script>
</body>
</html>