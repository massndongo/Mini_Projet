<?php
include_once dirname(__DIR__).'/traitement/fonctions.php';
$nb_question=0;
if (isset($_POST['nbr'])) {
    if (file_exists(dirname(__DIR__).'/data/parametre.json')) {
       $data = array(
           "nbr" => intval($_POST['nbr'])
       );
       $final_data=json_encode($data,true);
       file_put_contents(dirname(__DIR__).'/data/parametre.json', $final_data);
    }
    $dat=getData($file="parametre");
    $nb_question=$dat["nbr"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/listequestion.css">
    <title>Liste Questions</title>
</head>
<body>
    <form action="" method="post">
        <div class="form-control">
            <label class="text-nbr" for="">Nbre de question/jeu</label>
            <input class="input-nbr" type="text" name="nbr" id="" value="<?= isset($_POST['nbr']) ? $nb_question : ""; ?>">
            <input type="submit" name="btn" class="btn-ok" value="OK">
        </div>
    <div class="conteneur-question">
        <?php
            $aleatoire=[];
            $data=file_get_contents(dirname(__DIR__).'/data/questions.json');
            $data=json_decode($data,true);
            foreach ($data as $key => $aleatoire) {
                $questions[]=$aleatoire;
            }
                    for ($i=0; $i < count($questions) ; $i++) { 
                        $aleatoir[]=$questions[$i];
                    }
                    if (isset($_POST['suivant'])) {
                        $debut=$_SESSION['fin'];
                        $fin=$_SESSION['fin']+5;
                    }elseif (isset($_POST['precedent'])) {
                        $debut=$_SESSION['fin']-10;
                        $fin=$_SESSION['fin']-5;
                    }else {
                        $debut=0;
                        $fin=$nb_question;
                    }
                        for ($i=$debut; $i < $fin ; $i++) {
                            if ($i<count($aleatoir)) {
                                if($aleatoir[$i]["choixReponse"]=="choixM"){
                                    echo "<span class='question' style='font-size: 20px;color: #8e8071;font-weight: bold;padding-top:5px'>".($i+1).". ".$aleatoir[$i]["question"]."</span><br>";
                                    foreach ($aleatoir[$i]["reponse"]["correct"] as $repC) {
                                    echo "<input type='checkbox' checked='checked' class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:bold'>".$repC."</span><br>";
                                    }
                                    foreach ($aleatoir[$i]["reponse"]["fausse"] as $repF) {
                                        echo "<input type='checkbox' class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:bold'>".$repF."</span><br>";
                                    }
                                }
                                if($aleatoir[$i]["choixReponse"]=="choixS"){
                                    echo "<span class='question' style='font-size: 20px;color: #8e8071;font-weight: bold;padding-top:5px'>".($i+1).". ".$aleatoir[$i]["question"]."</span><br>";
                                    foreach ($aleatoir[$i]["reponse"]["correct"] as $repC) {
                                    echo "<input type='radio' name='radio_$i' checked='checked' class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:bold'>".$repC."</span><br>";
                                    }
                                    foreach ($aleatoir[$i]["reponse"]["fausse"] as $repF) {
                                        echo "<input type='radio' name='radio_$i' class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:bold'>".$repF."</span><br>";
                                    }
                                }
                                if($aleatoir[$i]["choixReponse"]=="choixT"){
                                    $val=$aleatoir[$i]["reponse"];
                                    echo "<span class='question' style='font-size: 20px;color: #8e8071;font-weight: bold;padding-top:5px'>".($i+1).". ".$aleatoir[$i]["question"]."</span><br>";
                                    echo "<input type='text' placeholder='$val' readonly='readonly' style='position:absolute;left:45px;'><br>";
                                }
                            }
                        } 
                $_SESSION['fin']=$fin;
        ?>
    </div>
    <div class="suivant" style="background-color: #f8f3f0;position: relative;bottom:23px;top:0; width: 100%; height: 14%;">
        <?php
            if (isset($_POST['suivant']) || $_SESSION['fin']>$nb_question) {  ?>
                <button name='precedent' style="float:left; background-color:#3addd6;top:10px;font-size:20px;color:white; height:50px; width:20%;">Precedent</button>
            <?php }else { ?>
                <button name='precedent' disabled='disabled' style="float:left; background-color:#818181;top:10px;font-size:20px;color:white;height:50px; width:20%;">Precedent</button>
            <?php }
            if ($_SESSION['fin']<count($aleatoir)) { ?>
                <button name='suivant' style="float:left;position:relative; left:300px;top:10px;font-size:20px;color:white;width:20%; background-color:#3addd6;height:50px; width:20%;">Suivant</button>
        <?php } else { ?>
                <button name='suivant' disabled='disabled' style="background-color:#818181;float:left;position:relative; left:300px;top:10px;font-size:20px;color:white;width:20%;height:50px; width:20%;">Suivant</button>
        <?php } ?>
    </div>
    </form>
    
</body>
</html>