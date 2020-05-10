<?php
    //FONCTION POUR VERIFIER LES INFORMATIONS DE CONNEXION
function verif_info_connexion($loginform,$mdpform){
    $file=file_get_contents(dirname(__DIR__).'/data/users.json');
    $file=json_decode($file, true);
    foreach ($file as $value) {
        $log=$value["login"];
        $pass=$value["mdp"];
        if ($log==$loginform && $pass==$mdpform) {
            return true;
        }
    }
    return false;
}
    //FONCTION POUR VERIFIER LES INFORMATIONS DE CONNEXION
function recup_info_user($loginform,$mdpform){
    $file=file_get_contents(dirname(__DIR__).'/data/users.json');
    $file=json_decode($file, true);
    foreach ($file as $value) {
        $log=$value['login'];
        $pass=$value['mdp'];
        if ($log==$loginform && $pass==$mdpform) {
             $result[]=$value;
        }
    }
    return $result;
}

function connexion($login,$pwd){
    $utilisateurs=getData();
    foreach ($utilisateurs as $user) {
        if ($user["login"]===$login && $user["mdp"]===$pwd)  {
            $_SESSION['user']=$user;
            $_SESSION['statut']="login";
            if ($user["role"]==="admin") {
                return "accueil";
            }else {
                return "jeux";
            }
        }
    }
    return "erreur";
}

function deconnexion(){
    unset($_SESSION['user']);
    unset($_SESSION['statut']);
    session_destroy();

}

function is_connect(){
    if (!isset($_SESSION['statut'])) {
        header("location:index.php");
    }
}

function getData($file="utiisateur"){
    $data=file_get_contents("../data/".$file.".json");
    $data=json_decode($data,true);
    return $data;
}
function aleatoire($tab,$n){
    shuffle($tab);
    for ($i=0; $i < $n ; $i++) { 
        $val[]=$tab[$i];
    }
    return $val;
}

function twodshuffle($array){
    // Get array length
    $count = count($array);
    // Create a range of indicies
    $indi = range(0,$count-1);
    // Randomize indicies array
    shuffle($indi);
    // Initialize new array
    $newarray = array($count);
    // Holds current index
    $i = 0;
    // Shuffle multidimensional array
    foreach ($indi as $index)
    {
        $newarray[$i] = $array[$index];
        $i++;
    }
    return $newarray;
}
?>