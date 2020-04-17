<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/inscription.css">
    <title>Inscription</title>
    <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
 <script type='text/javascript'>//<![CDATA[
 $(window).load(function(){
     function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
              
             reader.onload = function (e) {
                 $('#blah').attr('src', e.target.result);
             }
              
             reader.readAsDataURL(input.files[0]);
         }
     }
      
     $("#fichier").change(function(){
         readURL(this);
     });
 });//]]> 
  
 </script>
</head>
<body>
    <h3>S'INSCRIRE</h3>
    <p>Pour proposer des quizz</p>
    <hr>
    <form action="" method="post">
        <div class="form-controle">
            <label for="" class="label">Prénom</label>
            <input type="text" class="input-form" name="" id="">
        </div>
        <div class="form-controle">
            <label for="" class="label">Nom</label>
            <input type="text" class="input-form" name="" id="">
        </div>
        <div class="form-controle">
            <label for="" class="label">Login</label>
            <input type="text" class="input-form" name="" id="">
        </div>
        <div class="form-controle">
            <label for="" class="label">Password</label>
            <input type="password" class="input-form" name="" id="">
        </div>
        <div class="form-controle">
            <label for="" class="label">Confirmer Password</label>
            <input type="password" class="input-form" name="" id="">
        </div>
        <div class="form-controle" id="div-avatar">
            <label for="" class="avatar-text">Avatar</label>
            <label class="btn-file">Choisir un fichier</label>
            <input type="file" name="" id="fichier">
        </div>
        <div class="form-controle">
            <input type="submit" value="Créer compte" class="btn-submit" name="btn" id="">
        </div>
        <div class="avatar-img"><img src="" id="blah" alt="error" srcset=""></div>
        <label for="" id="avatar-texte">Avatar Admin</label>
    </form>
</body>
</html>