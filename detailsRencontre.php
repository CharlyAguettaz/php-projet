<?php
    if (!empty($_POST['id'] && isset($_POST['id']))) {
        $id_rencontre = htmlentities($_POST['id']);

        $db = 'football';
        $login="root";
        $mdp="";
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
        }
        catch (Exeption $e) {
            die('Error :' . $e->getMessage());
        }

        if (!empty($_POST['Points_equipe']) && !empty($_POST['Points_adversaire'])) {
            $Points_equipe=htmlentities($_POST['Points_equipe']);
            $Points_adversaire=htmlentities($_POST['Points_adversaire']);
            $req3 = $linkpdo->prepare("UPDATE football.rencontre SET Points_equipe = :points_equipe, Points_adversaire = :points_adversaire WHERE Id_rencontre = :Id_rencontre");
            $req3->execute(array('points_adversaire' => $Points_adversaire,'points_equipe' => $Points_equipe,'Id_rencontre' => $id_rencontre));
        }
        
        if (!empty($_POST['AD'])) {
            $Attaquant_droit = htmlentities($_POST['AD']);
            $req5 = $linkpdo->prepare("INSERT INTO football.participant(Attaquant_Droit) VALUE(:Attaquant_Droit)");
            $req5->execute(array('Attaquant_Droit' => $Attaquant_droit));
        }

        $req = $linkpdo->prepare("SELECT * FROM football.rencontre WHERE Id_rencontre LIKE ?");
        $req->execute(array($id_rencontre));
        $res=$req->fetch();
        $req2 = $linkpdo->prepare("SELECT nom,prenom,numLicence,statut FROM football.players");
        $req4 = $linkpdo->prepare("SELECT * FROM football.participant WHERE Id_rencontre LIKE ?");
        $req4->execute(array($id_rencontre));
        $res4 = $req4->fetch();
    }
?>

<html>
<link rel="stylesheet" href="style.css" />
    <head>
    
    </head>
    <body>
    <header>
    <nav class="menu">
               <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
               <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a> /
               <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> /
               <a href="http://localhost/php-projet/rencontre.php">Rechercher une rencontre</a>
         </nav>  
        <h1>Details de la rencontre entre Agen - <?php echo $res['Nom_adversaire'] ?></h1>
          </header>
         
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <p>
                Score du match : Agen <input type="number" value="<?php echo $res['Points_equipe'] ?>" name='Points_equipe' size="3"> - 
                <input type ="number" value=<?php echo $res['Points_adversaire']?> name ='Points_adversaire' size="3"> <?php echo $res['Nom_adversaire'] ?>
            </p>
            Attaquant droit :
            <select name='AD' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch();
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Attaquant gauche :
            <select name='AG' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Attaquant centre :
            <select name='AC' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur droit :
            <select name='DD' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur gauche :
            <select name='DG' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur centre :
            <select name='DC' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Gardien de but :
            <select name='GB' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch();
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            <input type="hidden" name='id' value=<?php echo $id_rencontre ?>>
            <input type="submit" value="Valider">
        </form>
    </body>
</html>