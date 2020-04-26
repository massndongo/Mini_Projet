<?php
if (isset($_POST['btn'])) {
    $question=$_POST['question'];
    $nbr_point=$_POST['nbr_point'];
    $type_rep=$_POST['type_rep'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../pulic/css/question.css">
    <title>Questions</title>
</head>
<body>
    <h3>PARAMETRER VOTRE QUESTION</h3>
    <div class="champQ">
        <form action="" method="post"  id="myform">
                <div class="formControl">
                    <label for="" class="lab">Question</label>
                    <textarea type="text" class="input" error="error-1" name="question" id=""></textarea>
                    <div class="error-form" id="error-1"></div>
                </div>
                <div class="formControl">
                    <label for="" class="lab">Nbre de Points</label>
                    <input type="number" class="input" error="error-2" name="nbr_point" id="">
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
                    <button type="button" onclick="onAddInput()" name="" id="" >+</button>
                    <div class="error-form" id="error-3"></div>
                </div>
                <div id="inputs">

                </div>
                <div class="formControl">
                    <input type="submit" name="btn" id="">
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
                                <input type="text" class="input" name="text" error="error-" id="text">
                                <div class="error-form" id="error-4"></div>
                                <input type="checkbox" name="chekbox" id="chekbox">
                                <button type="button" onclick="onDeleteInput(${nbRow})">X</button>`;
                                divInputs.appendChild(newInput);
                        }
                        if (document.getElementById('type').value=="choixS") {
                            newInput.innerHTML = `<label for="" class="lab">Réponse `+rep+`</label>
                                <input type="text" class="input" name="text" error="error-4" id="text">
                                <div class="error-form" id="error-4"></div>
                                <input type="radio" name="radio" id="radio">
                                <button type="button" onclick="onDeleteInput(${nbRow})">X</button>`;
                                divInputs.appendChild(newInput);
                        }
                        if (document.getElementById('type').value=="choixT") {
                            newInput.innerHTML = `<label for="" class="lab">Réponse `+rep+`</label>
                                <input type="text" class="input" name="text" error="error-4" id="text">
                                <div class="error-form" id="error-4"></div>
                                <button type="button" onclick="onDeleteInput(${nbRow})">X</button>`;
                                divInputs.appendChild(newInput);
                        }
                        
                    }
                    function onDeleteInput(n) {
                        var target = document.getElementById('formControl_'+n);
                        setTimeout(function(){
                            target.remove();
                        }, 500);
                        fadeOut('formControl_'+n);
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