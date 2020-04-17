<?php
session_start();
//session_destroy(); 
if (!isset($_SESSION['role'])) {
    header('location: connexion.php');
    exit;
}

?>

<script type="text/javascript"><!--
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
    <script type="text/javascript">
function envoieRequete(url,id)
{
	var xhr_object = null;
	var position = id;
	   if(window.XMLHttpRequest)  xhr_object = new XMLHttpRequest();
	  else
	    if (window.ActiveXObject)  xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); 

	// On ouvre la requete vers la page désirée
	xhr_object.open("GET", url, true);
	xhr_object.onreadystatechange = function(){
	if ( xhr_object.readyState == 4 )
	{
		// j'affiche dans la DIV spécifiées le contenu retourné par le fichier
		document.getElementById(position).innerHTML = xhr_object.responseText;
	}
	}
	// dans le cas du get
	xhr_object.send(null);

}
</script>
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
                <div class="petite-section">
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
                            <div class="li"><a href="#" onclick="envoieRequete('listequestion.php','myid');"><li><span class="text">Liste Questions</span><span class="icn"><img src="../public/icones/ic-liste.png" alt="" srcset=""></span></li></a></div>
                            <div class="li"><a href="#" onclick="envoieRequete('inscription.php','myid');"><li><span class="text">Créer Admin</span><span class="icn"><img src="../public/icones/ic-ajout.png" alt="" srcset=""></span></li></a></div>
                            <div class="li"><a href="#" onclick="envoieRequete('listejoueur.php','myid');"><li><span class="text">Liste Joueurs</span><span class="icn"><img src="../public/icones/ic-liste.png" alt="" srcset=""></span></li></a></div>
                            <div class="li"><a href="#" onclick="envoieRequete('question.php','myid');"><li><span class="text">Créer Questions</span><span class="icn"><img src="../public/icones/ic-ajout.png" alt="" srcset=""></span></li></a></div>
                        </ul>
                    </div>
                </div>
                <div class="grande-section" id="myid">
                </div>
            </div>
        </div>
    </body>
</html>