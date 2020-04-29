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
            <input class="input-nbr" type="text" name="nbr" id="" aleatoireue="<?= isset($nb_question) ? $nb_question : ""; ?>">
            <input type="submit" name="btn" class="btn-ok" value="OK">
        </div>
    <div class="conteneur-question">
        <?php
            $j=0;
            $aleatoire=[];
            $tabAffich=[];
            $data=file_get_contents(dirname(__DIR__).'/data/questions.json');
            $data=json_decode($data,true);
            foreach ($data as $key => $aleatoireue) {
                $questions[]=$aleatoireue;
            }
                    for ($i=0; $i < count($questions) ; $i++) { 
                        $aleatoire[]=$questions[$i];
                    }
                    if (isset($_POST['suivant'])) {
                        $debut=$_SESSION['fin'];
                        $fin=$_SESSION['fin']+5;
                    }elseif (isset($_POST['precedent'])) {
                        $debut=$_SESSION['fin']-10;
                        $fin=$_SESSION['fin']-5;
                    }else {
                        $debut=0;
                        $fin=5;
                    }
                        for ($i=$debut; $i < $fin ; $i++) {
                            if ($i<count($aleatoire)) {
                                if($aleatoire[$i]["choixReponse"]=="choixM"){
                                    echo "<span class='question' style='font-size: 20px;color: #8e8071;font-weight: bold;padding-top:5px'>".($i+1).". ".$aleatoire[$i]["question"]."</span><br>";
                                    foreach ($aleatoire[$i]["repCorrect"] as $repC) {
                                    echo "<input type='checkbox' class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:bold'>".$repC."</span><br>";
                                    }
                                    foreach ($aleatoire[$i]["repFausse"] as $repF) {
                                        echo "<input type='checkbox' class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:bold'>".$repF."</span><br>";
                                    }
                                }
                                if($aleatoire[$i]["choixReponse"]=="choixS"){
                                    echo "<span class='question' style='font-size: 20px;color: #8e8071;font-weight: bold;padding-top:5px'>".($i+1).". ".$aleatoire[$i]["question"]."</span><br>";
                                    foreach ($aleatoire[$i]["repCorrect"] as $repC) {
                                    echo "<input type='radio' name='radio_$i' class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:bold'>".$repC."</span><br>";
                                    }
                                    foreach ($aleatoire[$i]["repFausse"] as $repF) {
                                        echo "<input type='radio' name='radio_$i' class='bouton'><span style='position:absolute;left:45px;font-size=20px;font-weight:bold'>".$repF."</span><br>";
                                    }
                                }
                                if($aleatoire[$i]["choixReponse"]=="choixT"){
                                    echo "<span class='question' style='font-size: 20px;color: #8e8071;font-weight: bold;padding-top:5px'>".($i+1).". ".$aleatoire[$i]["question"]."</span><br>";
                                    echo "<input type='text' readonly='readonly' style='position:absolute;left:45px;'><br>";
                                }
                            }
                        } 
                $_SESSION['fin']=$fin;
        ?>
    <div class="suivant" style="background-color: #f8f3f0;position: relative;top: 141px; width: 100%; height: 14%;">
        <?php
            if (isset($_POST['suivant']) || $_SESSION['fin']>10) {  ?>
                <button name='precedent' style="float:left; background-color:#3addd6;top:10px;font-size:20px;color:white;
                height:20px; width:20%;
                ">Precedent</button>
            <?php }
            if ($_SESSION['fin']<count($aleatoire)) { ?>
                <button name='suivant' style="float:left;position:relative; left:400px;top:10px;font-size:20px;color:white;width:20%; background-color:#3addd6;
                height:20px; width:20%;
                ">Suivant</button>
        <?php } ?>
    </div>
    </div>
    </form>
    
</body>
</html>