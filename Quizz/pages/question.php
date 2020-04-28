<?php
$repCorrect=[];
$repFausse=[];
$data=file_get_contents(dirname(__DIR__).'/data/questions.json');
$data=json_decode($data,true);
if (isset($_POST['btn'])) {
    $question=$_POST['question'];
    $nbr_point=$_POST['nbr_point'];
    $type_rep=$_POST['type_rep'];
    if ($type_rep=="choixM") {
        if (isset($_POST['box'])) {
            foreach ($_POST['box'] as $value) {
                if(!empty($_POST['text'][$value])){
                    array_push($repCorrect,$_POST['text'][$value]);
                }
            }
            $repFausse=array_diff($_POST['text'],$repCorrect);
            if (file_exists(dirname(__DIR__).'/data/questions.json')) {
                $extrait=array(
                "question" => $question,
                "point" => $nbr_point,
                "choixReponse" => $type_rep,
                "repFausse" => $repFausse,
                "repCorrect" => $repCorrect
                );
                array_push($data,$extrait);
                $final_data=json_encode($data);
                file_put_contents(dirname(__DIR__).'/data/questions.json', $final_data);
            }else {
                $error="Fichier JSON inexistant!!";
            }
        }
    }elseif ($type_rep=="choixS") {
        if (isset($_POST['radio'])) {
            var_dump($_POST['radio']);
            foreach ($_POST['radio'] as $value) {
                if(!empty($_POST['text'][$value])){
                    array_push($repCorrect,$_POST['text'][$value]);
                }
            }
            $repFausse=array_diff($_POST['text'],$repCorrect);
            if (file_exists(dirname(__DIR__).'/data/questions.json')) {
                $extrait=array(
                "question" => $question,
                "point" => $nbr_point,
                "choixReponse" => $type_rep,
                "repFausse" => $repFausse,
                "repCorrect" => $repCorrect
                );
                array_push($data,$extrait);
                $final_data=json_encode($data);
                file_put_contents(dirname(__DIR__).'/data/questions.json', $final_data);
            }else {
                $error="Fichier JSON inexistant!!";
            }
        } 
    }
    elseif ($type_rep=="choixT") {
        if (isset($_POST['text'])) {
            $repCorrect=$_POST['text'];
            if (file_exists(dirname(__DIR__).'/data/questions.json')) {
                $extrait=array(
                "question" => $question,
                "point" => $nbr_point,
                "choixReponse" => $type_rep,
                "repCorrect" => $repCorrect
                );
                array_push($data,$extrait);
                $final_data=json_encode($data);
                file_put_contents(dirname(__DIR__).'/data/questions.json', $final_data);
            }else {
                $error="Fichier JSON inexistant!!";
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
    <link rel="stylesheet" href="../public/css/question.css">
    <title>Questions</title>
</head>
<body>
    <h3>PARAMETRER VOTRE QUESTION</h3>
    <div class="champQ">
        <form action="" method="post"  id="myform">
                <div class="formControl">
                    <label for="" class="lab">Question</label>
                    <textarea type="text" class="input" rows="10" cols="30" error="error-1" name="question" id=""></textarea>
                    <div class="error-form" id="error-1"></div>
                </div>
                <div class="formControl">
                    <label for="" class="lab">Nbre de Points</label>
                    <input type="number" class="input" error="error-2" name="nbr_point" id="nbr">
                    <div class="error-form" id="error-2"></div>
                </div>
                <div class="formControl">
                    <label for="" class="lab">Type de réponse</label>
                    <select name="type_rep" class="input" id="type" error="error-3">
                        <option value="">Donner le type de réponse</option>
                        <option value="choixM">Choix Multiple</option>
                        <option value="choixS">Choix Simple</option>
                        <option value="choixT">Choix Texte</option>
                    </select>
                    <button type="button" onclick="onAddInput()" name="" id="" ><img src="../public/icones/ic-ajout-réponse.png" alt="" srcset="" id="imgAjout"></button>
                    <div class="error-form" id="error-3"></div>
                </div>
                <div id="inputs">

                </div>
                <div class="formControl">
                    <input type="submit" name="btn" id="btn_submit" onclick="ctr()" value="Enrégistrer">
                </div>
        </form>
    </div>
    <script>
                var rep = 0;
                var nbRow = 0;
                    function onAddInput() {
                        nbRow++;
                        rep++
                        var divInputs = document.getElementById('inputs');
                        var newInput = document.createElement('div');
                        newInput.setAttribute('class','formControl');
                        newInput.setAttribute('id','formControl_'+nbRow);
                        if (document.getElementById('type').value=="choixM") {
                            newInput.innerHTML = `<label for="" class="lab">Réponse `+rep+`</label>
                                <input type="text" class="input" name="text[]" error="error-" id="text">
                                <input type="checkbox" name="box[]" id="id_${nbRow-1}" value="${nbRow-1}">
                                <button type="button" onclick="onDeleteInput(${nbRow})"><img src="../public/icones/ic-supprimer.png" alt="" srcset="" id="imgAjout"></button>`;
                                divInputs.appendChild(newInput);
                        }
                        if (document.getElementById('type').value=="choixS") {
                            newInput.innerHTML = `<label for="" class="lab">Réponse `+rep+`</label>
                                <input type="text" class="input" name="text[]" error="error-4" id="text">
                                <input type="radio" name="radio[]" id="id_${nbRow-1}" value="${nbRow-1}">
                                <button type="button" onclick="onDeleteInput(${nbRow})"><img src="../public/icones/ic-supprimer.png" alt="" srcset="" id="imgAjout"></button>`;
                                divInputs.appendChild(newInput);
                        }
                        if (document.getElementById('type').value=="choixT") {
                            newInput.innerHTML = `<label for="" class="lab">Réponse `+rep+`</label>
                                <input type="text" class="input" name="text" error="error-4" id="text">
                                <button type="button" onclick="onDeleteInput(${nbRow})"><img src="../public/icones/ic-supprimer.png" alt="" srcset="" id="imgAjout"></button>`;
                                divInputs.appendChild(newInput);
                        }
                        
                    }
                    function onDeleteInput(n) {
                        var target = document.getElementById('formControl_'+n);
                        setTimeout(function(){
                            target.remove();
                        }, 500);
                        fadeOut('formControl_'+n);
                        rep -= 1;
                    }
                    function fadeOut(idTarget) {
                        var target = document.getElementById('idTarget');
                        var effect = setInterval(function () {
                            if (!target.style.opacity) {
                                target.style.opacity = 1;
                            }
                            if (target.style.opacity>0) {
                                target.style.opacity-=0.1;
                            }else{
                                clearInterval(effect);
                            }
                        }, 200); 
                    }
                    function ctr() {
                        var atLeastOnechecked = false;
                        var i = 0;
                        while (document.getElementById("id_"+i)) {
                            if (document.getElementById("id_"+i).checked) {
                                atLeastOnechecked = true;
                                break;
                            }
                            i++;
                        }
                        if (atLeastOnechecked == true) {
                            return true;
                        }else{
                            alert("Coché au moins une case");
                            return false;
                        }
                    }
    
    </script>
    <script>
            const inputs=document.getElementsByClassName("input");
            for(input of inputs){
            input.addEventListener("keyup", function (e) {
                if(e.target.hasAttribute("error")) {
                    var idDivError=e.target.getAttribute("error")
                    document.getElementById(idDivError).innerText=""
                }
            })
            }
            document.getElementById("myform").addEventListener("submit", function(e){
            const inputs=document.getElementsByClassName("input");
                var error=false;
                for(input of inputs){
                    if (input.hasAttribute("error")) {
                        var idDivError=input.getAttribute("error");
                        if (!(input.value)) {
                            error=true;
                            document.getElementById(idDivError).innerText="Ce champ est obligatoire";
                        }else{
                            if (document.getElementById("nbr").value<1) {
                                error=true;
                            document.getElementById("error-2").innerText="Le nombre de points doit etre supérieur ou égale à 1";
                            }
                        }
                    }
                }
                if (error) {
                    e.preventDefault();
                    return false;
                }
                
            })
    </script>
</body>
</html>