<!DOCTYPE html>
<?php
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/listejoueur.css">
    <title>Liste des Joueurs</title>
</head>
<body>
    <h2 class="h2">LISTE DES JOUEURS PAR SCORE</h2>
    <div class="conteneur-joueur">
        <form action="" method="post">
            <table style="width:100%;height:auto;text-align:center;color:#818181">
                <tr>
                    <strong><th>Prénoms</th></strong>
                    <strong><th>Nom</th></strong>
                    <strong><th>Score</th></strong>
                </tr>
                <tr>
                    <?php
                        $data=file_get_contents(dirname(__DIR__).'/data/users.json');
                        $data=json_decode($data,true);
                        foreach ($data as $value) {
                            if ($value['role']=="joueur") {
                                $infosJ[]=$value;
                            }
                        }
                        $columns=array_column($infosJ,'score');
                        array_multisort($columns, SORT_DESC, $infosJ);
                        if (isset($_POST['suivant'])) {
                            $debut=$_SESSION['fin'];
                            $fin=$_SESSION['fin']+3;
                        }elseif (isset($_POST['precedent'])) {
                            $debut=$_SESSION['fin']-6;
                            $fin=$_SESSION['fin']-3;
                        }else {
                            $debut=0;
                            $fin=3;
                        }
                        for ($i=$debut; $i < $fin ; $i++) { 
                            if ($i<count($infosJ)) {
                            ?>
                            <td><?= $infosJ[$i]['prenom']; ?></td>
                            <td><?= $infosJ[$i]['nom']; ?></td>
                            <td><?= $infosJ[$i]['score']; ?></td>
                </tr>
                        <?php }
                        }
                        $_SESSION['fin']=$fin;
                        ?>
            </table>
            <div class="link-form">
                <?php
                    if (isset($_POST['suivant']) || $_SESSION['fin']>=6) {  ?>
                        <button class='suivant' name='precedent'>Precedent</button>
                   <?php }
                    if ($_SESSION['fin']<count($infosJ)) { ?>
                        <button name='suivant' class='suivant'>Suivant</button>
                   <?php }
                ?>
            </div>
        </form>
    </div>
</body>
</html>